@php
use App\Model\Attribute;
$attributeModel = new Attribute();
$attributeModel = new Attribute();
$attribute_color = Attribute :: where('name', 'color') ->get()->first();
$color_options = $attributeModel ->getAttributeOptions('color');
@endphp
<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@extends('layout')
@section('title', $product->name)
@section('middle_content')
<head>
 <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
 <script src="{{ asset('/js/productpage.js') }}"></script>
</head>

    <div class="product_view_main">
        @php
                $attr_info = array();               
                $image =  $product->image;                
                $price =  $product->base_price;
                $desc =  $product->desc;
                $short_desc =  $product->short_desc;
                if(!empty($product->attribute_values)){
                   $attr_info =  json_decode($product->attribute_values, true);
                }
                if(isset($attr_info["'price'"])) { unset($attr_info["'price'"]);  }
                $diff_attr_info =  json_decode($product->diff_attr_values, true);
                $image_path  = "media/product/small/$image";
                $product_id =  $product->product_id;
                $is_configurable =  $product->is_configurable;
        @endphp
        <input type="hidden" id="is_configurable" value={{$is_configurable}} />
        <div class="top-wrapper col-lg-12" style="height:80% ; background-color: #fff">
            <div class="image-wrapper col-lg-4" style="display: inline-block;min-height: 50%">
                <span class="left-image-bar"></span>
                <input type="hidden" id="productId" value="<?php echo $product_id ?>"/>
                <span class="image-box col-md-6 col-sm-6" >                  
                    <a href="{{ asset($image_path) }}" data-fancybox="images" data-width="1000">
                      <img src="{{ asset($image_path) }}" class="product-image-view" />
                    </a>
                </span>
            </div>
            <div class="content-wrapper col-lg-8">
                <div class="desc-box">
                    <div class='name'>{{$product->name}}</div>
                    <div class='review'>100 review</div>
                    <div class='price'>
                        <div class='label'>Special Price</div>
                        <div class='final-price'>{{renderPrice($price)}}</div>
                    </div>
                </div>
                <p class="short-desc">
                <p>{{$short_desc}} </p>
               </span>

                @if(count($config_data))                    
                <div class="no-selection-error alert alert-danger hide">
                    <strong>Please select color.</strong>
                </div>
                <div class="selection">
                    <div class="color"> Color :
                        <select style="list-style: none" id="color">
                            @foreach($config_data as $product)
                            @php
                                $tmp  = $product -> config_attributes;
                                $color_name = $color_options [$tmp[$attribute_color ->id]];
                            @endphp

                            <option style="background-color:{{ucfirst($color_name )}} ;min-width: 30px;min-height: 30px;  text-align: center;">
                                    <a href="/catalog/product/view/{{$product ->product_id}}">
                                        {{ucfirst($color_name )}}
                                </a>  
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>                        
                </div>
                @endif
                        
            @if(count($attr_info) && !$is_configurable)
             <div class="info">
                <table class="table attribute-table">
                @foreach( $attr_info as $attr_id => $attr_value)
                @php
                    $attribute = Attribute::where('id',$attr_id)->get();
                    if($attribute->first()) {
                    $attribute = $attribute->first();
                    $type = $attribute ->type;
                    $name = $attribute ->name;

        if($name == 'color' ||$name == 'size')  {

                    $options = json_decode($attribute ->options,true);
                    
                    if($type == 'select' && isset($options[$attr_value])) {
                     $option_value = $options[$attr_value];
                    }                    
                    else{
                    $option_value = $attr_value;
                    }
                @endphp
                <tr><td>{{$name}}  </td> <td>{{$option_value}}</td></tr>
         @php } } @endphp
                @endforeach
                </table>
             </div>           
            @endif
            <span class="actions">
            <span class="addtocart">
                <button id="addtocart" class="btn btn-success">ADD TO CART</button>
            </span>
            
            </span>
            </div>

    <div class="card">
      <div class="card-body">
    
        <div style="display: none;max-width:600px;" id="trueModal">
          <h2>I'm a modal!</h2>
          <p>You can close me only by pressing custom button below.</p>
          <p>It would also be possible to prevent closing using `beforeClose` callback.</p>
          <button data-fancybox-close class="btn btn-success">Close me</button>
        </div>
      </div>
    </div>

        </div>
@if(count($attr_info))
        <div class="bottom-wrapper details-tabs col-lg-12">
            <div class="tabs">  

                  <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#description">Description</a></li>
                    <li><a data-toggle="pill" href="#return">Return Policy</a></li>                
                  </ul>
                  
                  <div class="tab-content">
                    <div id="description" class="tab-pane fade in active">
                      @if(count($attr_info) && !$is_configurable)
                        
                            <table class="table attribute-table">
                            @foreach( $attr_info as $attr_id => $attr_value)
                            @php
                                $attribute = Attribute::where('id',$attr_id)->get();
                                if($attribute->first()) {
                                $attribute = $attribute->first();
                                $type = $attribute ->type;
                                $name = $attribute ->name;
                                $options = json_decode($attribute ->options,true);
                                
                                if($type == 'select' && isset($options[$attr_value])) {
                                 $option_value = $options[$attr_value];
                                }                    
                                else{
                                $option_value = $attr_value;
                                }
                            @endphp
                            <tr><td>{{$name}}  </td> <td>{{$option_value}}</td></tr>
                                    @php } @endphp
                            @endforeach
                            </table>
                        @else
                        <div class="no-record h4">Not Applicable</div>          
                        @endif
                    </div>
                    <div id="return" class="tab-pane fade">
                      <h3>Return Policy</h3>
                      <p>30 days free return</p>
                    </div>
                    
                  </div>
            </div>
        </div>
@endif
        <div class="card hide" id="successModal" >
            <div class="card-body">                                    
                    <div class="modal-header">
                        <h4 class="modal-title">Product Page</h4>                        
                    </div>
                    <div class="modal-body">
                        <p>{{$product->name}} successfully added to your cart.</ps>
                        <div class="actions">
                            <a href="/cart">
                            <button class="btn btn-success">                            
                                 Go To Cart
                            </button></a>
                            <button data-fancybox-close class="btn btn-success">Close</button>
                        </div>
                    </div>                
            </div>
        </div>
    </div>

@endsection
