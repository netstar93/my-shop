@extends('layout')
@section('title', 'Category List Page')
@section('middle_content')

    <div id="category_view_main">

        <div class="container">
            @if(isset($data))
                <div class='title'> {{  ucwords($data ->name) }} </div>
            @endif
            <div class="right-filter col-lg-2 col-xs-2">
                //FILTER

            </div>
            <div class="row col-lg-10 col-xs-10">
                @foreach($items as $item)
                    @php
                        $image = url('/media/product/thumb/'.$item->image);
                        //echo "<pre>"; print_r($item); die;
                           // $data = json_decode($item ->attribute_values , true);
                    @endphp
                    <div class="col-xs-6 col-sm-3 thumbnail">
                        <span class="img-box">
                                <a href="/catalog/product/view/{{$item ->product_id}}" title="{{ucfirst($item ->name)}}">
                                    <img class="group list-group-image" src="{{$image}}" width = "120px" alt="">
                                </a>
                          </span>
                        <div class="caption product-info">
                            <h5 class="group inner list-group-item-heading product-name">
                                <a href="/catalog/product/view/{{$item ->product_id}}">
                                    {{ucfirst($item ->name)}}</a>
                            </h5>
                            <hr>
                            <div class="price-section">
                                <span class="lead final-price">Rs. {{ $item ->base_price }}</span>
                                {{--<span class="special-price">Rs. {{ $item ->base_price }}</span>--}}
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
