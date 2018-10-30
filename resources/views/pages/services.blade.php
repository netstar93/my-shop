<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Order Success')
@section('middle_content')

<a href="/test">Pay Now</a>

@endsection

