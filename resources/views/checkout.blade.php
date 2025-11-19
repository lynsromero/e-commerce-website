@extends('layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="#">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Name</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">City</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Country</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Postcode/Zip</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Mobile Number</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address</label>
                            <input type="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-item ">
                            <label class="form-label my-3">Oreder Notes:</label>
                            <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11"
                                placeholder="Any special request?"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($cart->product->image) }}"
                                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4">{{ $cart->product->title }}</p>
                                            </td>
                                            @if ($cart->product->discount_price)
                                                <td>
                                                    <p class="mb-0 mt-4">{{ $cart->product->discount_price }} $</p>
                                                </td>
                                            @else
                                                <td>
                                                    <p class="mb-0 mt-4">{{ $cart->product->price }} $</p>
                                                </td>
                                            @endif
                                            <td>
                                                <p class="mb-0 mt-4">{{ $cart->quantity }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4 total_product_price">
                                                    {{ ($cart->product->discount_price ?? $cart->product->price) * $cart->quantity}}$
                                                </p>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-3">Subtotal</p>
                                        </td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">${{ $total_payout }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-4">Shipping</p>
                                        </td>
                                        <td colspan="3" class="py-5">
                                            <p class="mb-0 text-dark">Shipping cost is depend on the locations. After
                                                Placing the order we will mail you the shipping cost</p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">${{ $total_payout }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <a href="{{ route('stripe.index') }}"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection