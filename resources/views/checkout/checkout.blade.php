<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Checkout')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/js/productpage.js') }}"></script>
    <div class="checkout_index container-fluid">
        @php
        $default_expand ='';
        $customer = session('customer');
        if(isset($customer)){
            $default_expand = 'in';
        }
        @endphp

        <div class="page-title">Checkout </div>
         @if(true)
            <div class="checkout-steps" >
                @if(!isset($customer))
                    <section class="section account active">
                        <label class="step" data-toggle="collapse" data-target="#login"><span class="badge">1</span>Login</label>
                        <form class="form" method="post" id="checkout_login_form" novalidate>
                        <div class="collapse in" id="login">
                            {{ csrf_field() }}
                            <div class="error-validation">Please fill Email ID/password</div>
                            <div class="form-group">
                                <label for="name">Email Address:</label>
                                <input type="text" class="form-control" id="email" name="email" required="true" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>                                
                            </div>
                            <input type="hidden" class="form-control" id="ajax" name="ajax" value="1">
                            <div class="form-group">
                                <button id="checkout_login_submit" class="btn btn-success btn-rounded waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                        </form>
                    </section>
                @endif
                
               <section class="section shipping active">
                    <label class="step" data-toggle="collapse" data-target="#shippping-address"><span class="badge">2</span>Shipping Address</label>
                    <div class="collapse {{$default_expand}}" id="shippping-address">
                        @include('checkout/address_form')
                    </div>
                </section>

                <section class="section summary">
                    <label class="step" data-toggle="collapse" data-target="#summary"><span class="badge">3</span>Order Summary</label>
                    <div class="collapse" id="summary">
                        @include('checkout.order_summary')
                    </div>
                </section>

                <section class="section payment">
                    <label class="step" data-toggle="collapse" data-target="#payment-method"><span class="badge">4</span>Choose Payment Option</label>
                    <div class="collapse" id="payment-method">
                      @include('checkout/payment/methods')
                    </div>
                </section>
                
                <div class="orderBtn hidden">
                    <bottom class="btn btn-success lg" type="submit" id="ordernow">Order Now</bottom>
                </div>

                <div class="">
                     @include('checkout/form')
                </div>

            </div>

            <div class="cart-sidebar">
                <div class="title">ORDER SUMMARY</div>                
                <div class="subtotal"><span class="">Subtotal : </span> <span class="price">{{renderPrice($totals['subtotal'])}}</span></div>

                <div class="delivery"><span class="">Delivery Charges : </span> <span class="price">{{renderPrice($totals['shipping_amount'])}}</span></div>                
                
                <div class="grand-total">Grand Total : {{renderPrice($totals['grand_total'])}}   </div>
            </div>

            @else
            <div class="no-cart-item">No Item Found.Please shop items.</div>
        @endif
    </div>

@endsection

<style>

footer{
    display: none !important;
}
.checkout_index{
    margin-top:20px;
}
.menu-container{
    display: none !important;
}
.checkout_index > .page-title{
    font-size:30px;
}
</style>