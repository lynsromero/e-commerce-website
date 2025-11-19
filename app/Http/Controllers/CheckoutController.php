<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->where('quantity', '!=', 0)->get();

        $total_payout = 0;

        foreach ($carts as $cart) {
            $price = $cart->product->discount_price ?? $cart->product->price;
            $total_payout += ($cart->quantity * $price);
        }

        $data = [
            'total_payout' => $total_payout,
            'carts' => $carts
        ];

        return view('checkout')->with($data);
    }
}
