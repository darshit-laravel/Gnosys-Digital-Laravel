<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::id();

        try {
            DB::beginTransaction();

            $isSameAddress = $request->has('use_same_address_for_billing') && $request->use_same_address_for_billing == 1;

            $commonAddressData = [
                'shipping_first_name'  => $request->first_name,
                'shipping_last_name'   => $request->last_name,
                'shipping_address'     => $request->shipping_address,
                'shipping_apartment'   => $request->shipping_apartment,
                'shipping_city'        => $request->shipping_city,
                'shipping_province'    => $request->shipping_province,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_country'     => $request->shipping_country,
                'shipping_phone'       => $request->phone,

                'billing_first_name'   => $isSameAddress ? $request->first_name : $request->billing_firstname,
                'billing_last_name'    => $isSameAddress ? $request->last_name : $request->billing_lastname,
                'billing_address'      => $isSameAddress ? $request->shipping_address : $request->billing_address,
                'billing_apartment'    => $isSameAddress ? $request->shipping_apartment : $request->billing_apartment,
                'billing_city'         => $isSameAddress ? $request->shipping_city : $request->billing_city,
                'billing_province'     => $isSameAddress ? $request->shipping_province : $request->billing_province,
                'billing_postal_code'  => $isSameAddress ? $request->shipping_postal_code : $request->billing_postalcode,
                'billing_country'      => $isSameAddress ? $request->shipping_country : $request->billing_country,
                'billing_phone'        => $isSameAddress ? $request->phone : $request->billing_phone,
            ];

            $order = Order::create([
                'user_id'              => $id ?? null,
                'guest_email'          => $request->email,
                'order_number'         => 'ORD-' . strtoupper(substr(uniqid(), -6)),
                'subtotal'             => $request->order_product_grand_total,
                'total_amount'         => $request->order_product_grand_total,
                'status'               => 'pending',
                'payment_status'       => 'pending',
                ...$commonAddressData
            ]);

            $address = Address::updateOrInsert([
                'user_email'           => $request->email
            ],
            [
                'user_id'              => auth()->check() ? auth()->id() : null,
                'user_email'           => $request->email,
                ...$commonAddressData
            ]);

            if ($request->has('order_product_id') && is_array($request->order_product_id)) {
                $orderItems = [];

                foreach ($request->order_product_id as $index => $productId) {
                    $orderItems[] = [
                        'order_id'      => $order->id,
                        'product_id'    => decrypt($productId),
                        'product_title' => !empty($request->order_product_title[$index]) ? $request->order_product_title[$index] : null,
                        'price'         => !empty($request->order_product_price[$index]) ? $request->order_product_price[$index] : null,
                        'quantity'      => !empty($request->order_product_qty[$index]) ? $request->order_product_qty[$index] : null,
                        'total_amount'  => !empty($request->order_product_total_amount[$index]) ? $request->order_product_total_amount[$index] : null,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }

                OrderItem::insert($orderItems);
                $pids = array_column($orderItems, 'product_id');
                if ($id && $pids) {
                    Cart::whereIn('product_id', $pids)->where('user_id', $id)->delete();
                } else {
                    session()->forget('cart');
                }
            }

            DB::commit();

            return response()->json([
                'status'       => 'success',
                'message'      => 'Order created successfully!',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'order_grand_total' => $request->order_product_grand_total,
                    'transection_id' => $order->order_number
                ]
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Order Error => '. $th->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while placing your order.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
