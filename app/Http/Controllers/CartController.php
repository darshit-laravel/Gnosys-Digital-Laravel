<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DigitalProduct;
use App\Models\DigitalService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $id = Auth::id();

        $carts = collect();
        $grandTotal = 0;

        if ($id) {
            $carts = Cart::where('user_id', $id)->get();
            $grandTotal = Cart::where('user_id', $id)->sum(DB::raw('product_qty * product_price'));
        } else {
            $sessionCarts = session()->get('cart', []);

            foreach ($sessionCarts as $item) {
                $price = 0;

                if ($item['type'] == 'product') {
                    $dp = DigitalProduct::find($item['id']);
                    $price = !empty($dp) ? $dp->price : 0;
                } elseif ($item['type'] == 'service') {
                    $ds = DigitalService::find($item['id']);
                    $price = !empty($ds) ? $ds->price : 0;
                }

                $cartItem = (object) [
                    'product_id'    => $item['id'],
                    'product_title' => $item['title'],
                    'product_img'   => $item['image'],
                    'product_type'  => $item['type'],
                    'product_price' => $price,
                    'product_qty'   => $item['qty'],
                ];

                $carts->push($cartItem);
                $grandTotal += ($price * $item['qty']);
            }
        }

        return view('cart', compact('carts', 'grandTotal'));
    }

    public function checkoutIndex(Request $request) {
        return view('checkout');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
        ]);

        try {
            $realProductId = decrypt($request->product_id);
        } catch (DecryptException $e) {
            return response()->json(['error' => 'Invalid product data.'], 400);
        }

        $authUser = Auth::id();

        if ($authUser) {
            $updated = Cart::where('user_id', $authUser)
                ->where('product_id', $realProductId)
                ->update(['product_qty' => $request->quantity]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully.',
                ], 200);
            }

            return response()->json(['error' => 'Item not found in cart.'], 404);

        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$realProductId])) {

                $cart[$realProductId]['qty'] = $request->quantity;

                session()->put('cart', $cart);

                return response()->json([
                    'success' => true,
                    'message' => 'Cart session updated successfully.',
                ], 200);
            }

            return response()->json(['error' => 'Item not found in session cart.'], 404);
        }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        try {
            $realProductId = decrypt($request->product_id);
        } catch (DecryptException $e) {
            return response()->json(['error' => 'Invalid product data.'], 400);
        }

        $authUser = Auth::id();

        if ($authUser) {
            $deleted = Cart::where('user_id', $authUser)
                ->where('product_id', $realProductId)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cart'    => Cart::where('user_id', $authUser)->count(),
            ], 200);

            return response()->json(['error' => 'Item not found in cart.'], 404);

        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$realProductId])) {

                unset($cart[$realProductId]);

                session()->put('cart', $cart);

                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from session cart.',
                    'cart'    => !empty($cart) ? count($cart) : 0,
                ], 200);
            }

            return response()->json(['error' => 'Item not found in session cart.'], 404);
        }
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|string',
            'product_title' => 'required|string|max:255',
            'product_img'   => 'required|string',
            'product_type'  => 'required|string|max:100',
            'product_price' => 'nullable|numeric|min:0',
            'product_qty'   => 'required|integer|min:1',
        ]);

        try {
            $id = decrypt($request->product_id);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid product ID.'
            ], 400);
        }

        $title = $request->product_title;
        $img   = $request->product_img;
        $type  = $request->product_type;
        $reqQty = $request->product_qty;
        $authUser = Auth::id();

        try {
            if ($authUser) {

                $price = 0;
                if ($type == 'product') {
                    $dp = DigitalProduct::find($id);
                    $price = ($dp && $dp->price) ? $dp->price : 0;
                } elseif ($type == 'service') {
                    $ds = DigitalService::find($id);
                    $price = ($ds && $ds->price) ? $ds->price : 0;
                }

                $existingCartItem = Cart::where('user_id', $authUser)->where('product_id', $id)->first();

                if ($existingCartItem) {
                    $newQty = ($type == 'product') ? 1 : ($existingCartItem->product_qty + $reqQty);

                    $existingCartItem->update([
                        'product_qty' => $newQty,
                        'product_price' => $price
                    ]);
                } else {
                    $initialQty = ($type == 'product') ? 1 : $reqQty;

                    Cart::create([
                        'user_id'       => $authUser,
                        'product_id'    => $id,
                        'product_title' => $title,
                        'product_img'   => $img,
                        'product_type'  => $type,
                        'product_price' => $price,
                        'product_qty'   => $initialQty,
                    ]);
                }

                $cart = Cart::where('user_id', $authUser)->get();
            } else {
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['qty'] = ($type == 'product') ? 1 : ($cart[$id]['qty'] + $reqQty);

                    if (empty($cart[$id]['type'])) {
                        $cart[$id]['type'] = $type;
                    }
                } else {
                    $cart[$id] = [
                        'id'    => $id,
                        'title' => $title,
                        'image' => $img,
                        'type'  => $type,
                        'qty'   => ($type == 'product') ? 1 : $reqQty,
                    ];
                }

                session()->put('cart', $cart);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Product added to cart successfully!',
                'cart' => $cart
            ]);

        } catch (\Exception $e) {
            Log::error('Add To Cart Error: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    public static function storeCartitems()
    {

        $authUser = Auth::id();
        $cartSession = session()->get('cart', []);

        if (empty($cartSession) || !$authUser) {
            return;
        }

        try {
            foreach ($cartSession as $key => $item) {
                $existingCartItem = Cart::where('user_id', $authUser)
                                        ->where('product_id', $item['id'])
                                        ->first();

                if ($item['type'] == 'product') {
                    $dp = DigitalProduct::find($item['id']);
                    if (!empty($dp) && !empty($dp->price)) {
                        $price = $dp->price;
                    }
                } else if ($item['type'] == 'service') {
                    $ds = DigitalService::find($item['id']);
                    if (!empty($ds) && !empty($ds->price)) {
                        $price = $ds->price;
                    }
                } else {
                    $price = 0;
                }

                if (!empty($existingCartItem)) {
                    $existingCartItem->product_qty += $item['qty'];
                    $existingCartItem->update();
                } else {
                    Cart::create([
                        'user_id' => $authUser,
                        'product_id' => $item['id'],
                        'product_title' => $item['title'],
                        'product_img' => $item['image'],
                        'product_type' => $item['type'],
                        'product_price' => $price,
                        'product_qty' => $item['qty'],
                    ]);
                }
            }

            session()->forget('cart');

        } catch (\Exception $e) {
            Log::error('Error storeCartitems() -> ' . $e->getMessage());
        }
    }
}
