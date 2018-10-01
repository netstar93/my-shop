<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Order Success')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <div class="checkout_cart_success container-fluid">
        {{--<div class="page-title">Shopping Cart</div>--}}
        @if(isset($order_id))
            <h3>Your order is succcessfully placed !!!</h3>
                    <h4>ORDER ID :: {{$order_id}}</h4>
           @else
            <h3>{{$error}}</h3>
            @endif
    </div>

@endsection
