@extends('layout')
@section('title', 'Category List Page')
@section('middle_content')
    <head>
        <script src="{{ asset('/js/cart.js') }}"></script>
    </head>
    <div id="category_view_main" class="category-view-main">
        <div class="container-fluid">
            <div class="right-filter col-lg-3 col-xs-3">

                @include('catalog.category.filter')

            </div>
            <div class="row col-lg-9 col-xs-9 product-grid">

                @if(isset($data))
                    <div class='title'> {{  ucwords($data ->name) }} </div>
                @endif
                @foreach($items as $item)
                    @php
                        $image = url('/media/product/thumb/'.$item->image);
                    @endphp
                    <div class="col-xs-6 col-lg-3 category-list-item">
                        <div class="img-box">
                            <a href="/catalog/product/view/{{$item ->product_id}}" title="{{ucfirst($item ->name)}}">
                                <img class="group list-group-image" src="{{$image}}" width="150px" alt="">
                            </a>
                        </div>
                        <div class="caption product-info">
                            <h5 class="group inner product-name">
                                <a href="/catalog/product/view/{{$item ->product_id}}">
                                    {{ucfirst($item ->name)}}</a>
                            </h5>
                            <hr>
                            <div class="price-section">
                                <span class="lead final-price">{{ renderPrice($item ->base_price) }}</span>
                                {{--<span class="special-price">{{ renderPrice($item ->base_price) }}</span>--}}
                            </div>
                            {{--<div class="actions-item">--}}
                            {{--<button class="btn btn-sm btn-success">Add to Cart</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
