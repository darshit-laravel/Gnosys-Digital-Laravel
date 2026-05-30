<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class CommonController extends Controller
{
    public function getState(Request $request) {
        $states = State::where('country_id', $request->id)->get();

        return response()->json([
            'status' => 'success',
            'states' => $states
        ]);

    }

    public static function updateUserData() {

        if (auth()->check()) {
            try {
                $user = auth()->user();

                $order = Order::whereNull('user_id')
                        ->where('guest_email', $user->email)
                        ->update(['user_id' => $user->id]);

                $address = Address::whereNull('user_id')
                        ->where('user_email', $user->email)
                        ->update(['user_id' => $user->id]);
            } catch (\Throwable $e) {
                Log::error('updateUserData() error -> '. $e->getMessage());
            }
        }
    }
}
