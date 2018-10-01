<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title','Customer Login')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <div class="customer_register_form">
        <div class="page-title">Customer Login Form</div>
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
        
            <form method="POST" action="{{url('/customer/checklogin')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Email Address:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                </div>
{{--                @include('partials.formerrors')--}}
            </form>

    </div>
@endsection