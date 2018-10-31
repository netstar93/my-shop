<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Order Success')
@section('middle_content')

    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <div class="order-success-page container text-center">
        <!-- <div class="page-title">Order Successful </div> -->
        @if(isset($order_id) && Session::has('success_pay'))
            <i class="fa fa-check-circle" style="font-size:50px;color:green"></i>
            <h2>Your order is successfully placed.</h2>
            <h3>Your Order ID is #<b>{{$order_id}}</b></h3>
        @else
         <i class="fa fa-frown-o" style="font-size:60px;color:red"></i>
         <h3 class="error alert">{{Session::get('error')}}</h3>
        @endif

       <a href="/"> <button class="btn-success btn-lg"><i class="fa fa-home" aria-hidden="true"></i></button></a>
    </div>

@endsection

