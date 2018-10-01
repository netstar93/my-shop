<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Checkout')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/js/productpage.js') }}"></script>
    <div class="checkout_index container-fluid">
        @php
        $customer = session('customer');
         @endphp

        <div class="page-title">Checkout </div>
         @if(true)
            <div class="checkout-steps" >
                @if(!isset($customer))
                    <section class="section account">
                        <label data-toggle="collapse" data-target="#login"><span class="badge">1</span>Login</label>
                        <form class="form" id="checkout_login_form">
                        <div class="collapse in" id="login">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Email Address:</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input type="hidden" class="form-control" id="ajax" name="ajax" value="1">
                            <div class="form-group">
                                <button id="checkout_login_submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </section>
                @endif
                
               <section class="section shipping">
                    <label data-toggle="collapse" data-target="#shippping-address">Shipping Address</label>
                    <div class="collapse" id="shippping-address">
                        @include('checkout/address_form')
                    </div>
                </section>

                <section class="section summary">
                    <label data-toggle="collapse" data-target="#summary">Order Summary</label>
                    <div class="collapse1" id="summary">
                        @include('checkout.order_summary')
                    </div>
                </section>

                <section class="section payment">
                    <label data-toggle="collapse" data-target="#payment-method">Choose Payment Option</label>
                    <div class="collapse" id="payment-method">
                      @include('checkout/payment/methods')
                    </div>
                </section>
                    <div class="">
                        <bottom class="btn btn-success lg" type="submit" id="ordernow">Order Now</bottom>
                    </div>
                </form>
            </div>

            <div class="cart-sidebar">
                <div class="title">ORDER SUMMARY</div>
                <hr>
                <div class="price"><span class="">Price (2 items) : </span> <span class="price">Rs. 200</span></div>
                <div class="delivery"><span class="">Delivery Charges : </span> <span class="price">Rs. 200</span></div>
                <div class="subtotal"><span class="">Subtotal : </span> <span class="price">Rs. 200</span></div>
                <div class="grand-total">Grand Total : Rs.2000   </div>
            </div>

            @else
            <div class="no-cart-item">No Item Found.Please shop items.</div>
        @endif
    </div>

@endsection
