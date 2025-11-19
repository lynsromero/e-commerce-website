<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->where('quantity', '!=', 0)->get();
        $user = Auth::user();
        $total_payout = 0;

        foreach ($carts as $cart) {
            $price = $cart->product->discount_price ?? $cart->product->price;
            $total_payout += ($cart->quantity * $price);
        }

        $data = [
            'total_payout' => $total_payout,
            'carts' => $carts,
            'user' => $user,
        ];

        return view('checkout')->with($data);
    }
}
