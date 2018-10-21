@extends('layout')
@section('title', 'Home Page')
@section('middle_content')
<div id="container">
     @include('home/slider')
    @include('home/featured_product')
</div>
@endsection
