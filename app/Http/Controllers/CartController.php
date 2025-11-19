<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
        public function cart()
    {
        $cart_products = Cart::where('user_id', Auth::id())->get();

        return view('cart', compact('cart_products'));
    }

    public function addCart(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if (!$cart) {

            $cart = new Cart();
            $cart->product_id = $request->product_id;
            $cart->user_id = Auth::id();
            $cart->save();
        }
        $cart_counter = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success' => true, 'cart_counter' => $cart_counter, 'message' => 'Product added to cart']);
    }
    public function updateCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->quantity = $request->quantity;
        $cart->save();
        $cart_counter = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success' => true, 'cart_counter' => $cart_counter]);
    }


    public function removeCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->delete();

        $cart_counter = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success' => true, 'cart_counter' => $cart_counter]);
    }

    public function totalPayout(Request $request)
    {
        $cart = Cart::find($request->cart_id);

        $carts = Cart::where('user_id',  Auth::id())->get();

        $total_payout = 0;

        foreach ($carts as $cart) {
            $price = $cart->product->discount_price ?? $cart->product->price;
            $total_payout += ($cart->quantity * $price);
            
        }

        return response()->json(['success' => true, 'total_payout' => $total_payout]);
    }
}
