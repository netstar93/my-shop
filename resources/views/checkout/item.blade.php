@php
    $img =$color = $size = '';  
    $item = $productModel -> load($item ->product_id) ->first();

    if(isset($item ->image))
    $img = $item ->image;

    $image_path  = url("media/product/thumb/$img");
    if(!empty($item ->attribute_values)) {
      $attr_values =  json_decode($item ->attribute_values, true);
    }

@endphp
@if(is_object($item))
<div class="cart-item row">
  <tr>
  <td>  <img src={{$image_path}}  width="100px" /></td>
  <td>
      <div class="item-info" width="60%">
          <div class="name">{{$item ->name}} </div>
          <div class="seller-name">Sold BY : {{$item ->seller_id}} </div>
          <div class="custom-options">
              @if(!empty($size))
              <span>Size: <b>{{ucfirst($size)}}</b></span>
              @endif
                  @if(!empty($color))
                      <span>Color: <b>{{ucfirst($color)}}</b></span>
                  @endif
          </div>
          <span class="cart-item-remove" value="{{$item ->product_id}}">Remove</span>
      </div>
  </td>
      <td> Delivered By 10 th September 2018</td>
      <td><span class="subtotal">Rs.{{$item ->base_price}} </span></td>
  </tr>
</div>
@endif