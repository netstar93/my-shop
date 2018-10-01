<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title','Customer Sign Up')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <div class="customer_register_form">
        <div class="page-title">Customer Registeration Form</div>
        @if(count($errors))
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <br/>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form method="POST" action="{{url('/customer/save')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email_address">
                </div>
                <div class="form-group">
                    <label for="email">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
@endsection