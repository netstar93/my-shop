@php
    $img =$color = $size = '';  
    $qty = $item_data ->qty; 
    $item = $productModel -> load($item_data ->product_id) ->first();

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
  <td class="product-image">  <img src={{$image_path}}  width="100px" /></td>
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
          <span class="cart-item-remove" style="color: orangered;cursor: pointer;opacity: 0.9" item_id ="{{$item ->id }}" value="{{$item ->product_id}}"><i class="fa fa-trash" aria-hidden="true" ></i></span>
      </div>
  </td>
  <td>

    <span class="input-group-btn">        
        <button type="button" class="quantity-right-plus btn-xs btn-success btn-number" data-type="plus" data-field="">  <span class="glyphicon glyphicon-plus"></span>
                </button>

    </span>

    <input style="max-width: 50px" type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">

    <span class="input-group-btn">
        <button type="button" class="quantity-left-minus btn-xs btn-danger btn-number"  data-type="minus" data-field="">
          <span class="glyphicon glyphicon-minus"></span>
        </button>

    </span>
  
  </td>
      <td> Delivered By 10 th September 2018</td>
      <td><span class="subtotal">Rs.{{$item ->base_price  * $qty}} </span></td>
  </tr>
</div>
@endif