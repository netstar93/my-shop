<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title','Welcome Home')
@section('middle_content')
    {{--    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>--}}
    @php
        $customer = session('customer');
        $is_logged_in =  $customer['logged_in'];
        $name =  $customer['name'];
    @endphp
    @if(isset($is_logged_in))
        <div class="customer_dashboard_index container">
            <div class="row">
            <div class="page-title">Your Dashboard</div>
            <div class="main-wrapper">
                <div class="row no-gutters">
                <span class="col-xs-4 col-lg-4 customer-tabs-column">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#summary" role="tab" aria-controls="summary">Account
                            Summary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#orders" role="tab" aria-controls="profile">My
                            Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address" role="tab" aria-controls="messages">Addresses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#wishlist" role="tab" aria-controls="messages">My
                            Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#balance" role="tab" aria-controls="messages">My
                            Balance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">Settings</a>
                    </li>
                </ul>
            </span>
                    <div class="tab-content customer-tabs col-xs-8 col-lg-8">
                <span class="tab-pane active" id="summary" role="tabpanel">
                    <h3>Account Summary</h3>
                        <span class="account-info">
                            <img class="img-circle img-responsive fa fa-user-circle-o" style="font-size:70px " src=""/>
                            <span class="info-short">
                                <p class="name">{{$name}}</p>
                               <p class="email">{{$customer['email_address']}}</p>
                             </span>
                            <a href="#">Edit Profile</a>
                        </span>
                    </span>
                        <div class="tab-pane" id="orders" role="tabpanel">
                            <h3>My Orders</h3>
                        </div>
                        <div class="tab-pane" id="address" role="tabpanel">
                            <h3>Addresses</h3>
                        </div>
                        <div class="tab-pane" id="balance" role="tabpanel">
                            <h3>Cashbacks </h3>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <h3>Settings</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endif
@endsection