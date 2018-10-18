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
@section('title', $data->name)
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/js/productpage.js') }}"></script>
    <div class="product_view_main">
        @php
                $attr_info = array();
                $status =  $data->status;
                $image =  $data->image;
                $product_name =  $data->name;
                $price =  $data->base_price;
                $desc =  $data->desc;
                $short_desc =  $data->short_desc;
                if(!empty($data->attribute_values)){
                   $attr_info =  json_decode($data->attribute_values, true);
                }
                if(isset($attr_info["'price'"])) { unset($attr_info["'price'"]);  }
                $diff_attr_info =  json_decode($data->diff_attr_values, true);
                $image_path  = "media/product/small/$image";
                $product_id =  $data->product_id;
                $is_configurable =  $data->is_configurable;
        @endphp
        <input type="hidden" id="is_configurable" value={{$is_configurable}} />
        <div class="top-wrapper">
            <div class="image-wrapper col-lg-4" style="display: inline-block;min-height: 50%">
                <span class="left-image-bar"></span>
                <input type="hidden" id="productId" value="<?php echo $product_id ?>"/>
                <span class="image-box col-md-6 col-sm-6">
                <img src="{{ asset($image_path) }}" class="product-image-view"/>
            </span>
            </div>
            <div class="content-wrapper col-lg-8">
                <div class="desc-box">
                    <div class='name'>{{$product_name}}</div>
                    <div class='review'>100 review</div>
                    <div class='price'>
                        <div class='label'>Special Price</div>
                        <div class='final-price'>Rs. {{$price}}</div>
                    </div>
                </div>
                <p class="short-desc">
                <p>{{$short_desc}} </p>
               </span>

                @if(count($config_data))                    
                <div class="no-selection-error alert alert-danger hide">
                    <strong>Please select color.</strong>
                </div>
                    <div class="selection" style="display: inline-block;">
                        <div class="color"> Color :
                            <ul style="list-style: none" id="color">
                                @foreach($config_data as $data)
                                @php
                                    $tmp  = $data -> config_attributes;
                                    $color_name = $color_options [$tmp[$attribute_color ->id]];
                                @endphp

                                    <li style="background-color:{{ucfirst($color_name )}} ;min-width: 30px;min-height: 30px;  text-align: center;">
                                        <a href="/catalog/product/view/{{$data ->product_id}}">
                                            {{ucfirst($color_name )}}
                                </a>  
                                </li>                                                    
                                @endforeach
                            </ul>
                        </div>                        
                    </div>
                @endif
                        
            @if(count($attr_info) && !$is_configurable)
             <div class="info">
                <table class="table attribute-table">
                @foreach( $attr_info as $attr_id => $attr_value)
                @php
                    $attribute = Attribute::where('id',$attr_id)->get()->first();
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
                @endforeach
                </table>
             </div>           
@endif
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
            <div class="title">     </div>
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
                        <div class="info well">{{$product_name}} Added successfully.</div>
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
