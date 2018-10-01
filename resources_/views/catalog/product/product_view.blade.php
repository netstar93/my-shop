<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', 'Product Page')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/js/productpage.js') }}"></script>
    <div class="product_view_main">
        @php
           // echo "<pre>"; print_r($data); die;
                $status =  $data->status;
                $image =  $data->image;
                $name =  $data->name;
                $price =  $data->base_price;
                $desc =  $data->desc;
                $short_desc =  $data->short_desc;
                $attr_info =  json_decode($data->attribute_values, true);
                $diff_attr_info =  json_decode($data->diff_attr_values, true);
                $image_path  = url("/media/product/$image");
                $product_id =  $data->product_id;
        @endphp
        <div class="top-wrapper">
            <div class="image-wrapper col-lg-4" style="display: inline-block;min-height: 50%">
                <span class="left-image-bar"></span>
                <input type="hidden" id="productId" value="<?php echo $product_id ?>"/>
                <span class="image-box col-md-6 col-sm-6">
                <img src="{{asset($image_path)}}" class="product-image-view"/>
            </span>
            </div>
            <div class="content-wrapper col-lg-8">
                <div class="desc-box">
                    <div class='name'>{{$name}}</div>
                    <div class='review'>100 review</div>
                    <div class='price'>
                        <div class='label'>Special Price</div>
                        <div class='final-price'>Rs. {{$price}}</div>
                    </div>
                </div>
                <p class="short-desc">
                <p>{{$short_desc}} </p>
               </span>

                {{--<div class="selection" style="display: inline-block;">--}}
                    {{--<div class="color"> Color :--}}
                        {{--<ul style="list-style: none">--}}
                            {{--<li> <a href="#">Red</a>  </li>--}}
                            {{--<li> <a href="#">Blue</a>  </li>--}}
                            {{--<li> <a href="#">Pink</a>  </li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="color"> Size :--}}
                        {{--<ul style="list-style: none">--}}
                            {{--<li> <a href="#">S</a>  </li>--}}
                            {{--<li> <a href="#">M</a>  </li>--}}
                            {{--<li> <a href="#">L</a>  </li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                </div>

                <span class="actions">
            <span class="addtocart">
                <button id="addtocart" class="btn btn-success">ADD TO CART</button>
            </span>
            <span class="buynow">
                <button id="buynow" class="btn btn-primary">BUY NOW</button>
            </span>
            </span>
            </div>
        </div>

        <div class="bottom-wrapper">
            <div class="title">   Product Details   </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Product Page</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="info well">{{$name}} Added successfully.</div>
                        <div class="actions">
                            <a href="/cart">
                                <button class="btn btn-success"> Go To Cart</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
