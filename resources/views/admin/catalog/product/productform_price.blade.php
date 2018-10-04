@php 
$base_price = $special_price = null;
if($data){
    $base_price = $data ->base_price;
    $special_price = $data ->special_price;
}
@endphp

<div class="form-group form-inline">                        
    <label for="uname1">Base Price</label>
    <input type="text" class="form-control form-control-lg" value="{{$base_price}}" name="base_price" required="true">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>
<div class="form-group form-inline">                        
    <label for="uname1">Special Price</label>
    <input type="text" class="form-control form-control-lg" value="{{$special_price}}"  name="special_price">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>
                    
