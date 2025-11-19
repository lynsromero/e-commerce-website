<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    /**
     * Display the payment form.
     */
    public function index(): View
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
        return view('stripe')->with($data);
    }

    /**
     * Process the Stripe payment.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $carts = Cart::where('user_id', Auth::id())
                ->where('quantity', '!=', 0)
                ->get();

            $total_payout = 0;
            $user = Auth::user();

            $userInfo = [
                'Name: ' . $user->name,
                'Email: ' . $user->email,
            ];
            foreach ($carts as $cart) {
                $price = $cart->product->discount_price ?? $cart->product->price;
                $total_payout += ($cart->quantity * $price);
            }

            $description = 'Payment form: ' . implode(', ', $userInfo);

            $amountInCents = round($total_payout * 100);

            Charge::create([
                'amount' => $amountInCents,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => $description,
            ]);

            return back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
