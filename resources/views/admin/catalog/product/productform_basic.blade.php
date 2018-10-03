@php 
$name = $id = $desc = $short_desc= $sku = null;
if($data){
    $id = $data ->id;
    $product_id = $data ->product_id;
    $name = $data ->name;
    $desc = $data ->desc;
    $short_desc = $data ->short_desc;
    $sku = $data ->sku;
    $status = $data ->status;
    $base_price = $data ->base_price;
    $diff_attr_values = $data ->diff_attr_values;
    $diff_attr_values = $data ->diff_attr_values;
}
@endphp

@if($id > 0)
    <input type="hidden" name="id" value = "{{$id}}" class="" />
@endif
<input type="hidden" name="status" value = "1" class="checkbox" />

<div class="form-group form-inline">                        
    <label for="name">Name</label>
    <input type="text" class="form-control form-control-lg" value = "{{ $name}}" name="name" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Description</label>
    <input type="text" class="form-control form-control-lg" name="description" value = "{{ $desc}}" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Short Description</label>
    <input type="text" class="form-control form-control-lg" name="short_description" value="{{$short_desc}}" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Product Attribute Set</label>
    <select class="form-control form-control-lg" id="attributeset" name="attributeset" required="">
        <option value="1">Clothes</option>        
        <option value="2">Electronics</option>        
    </select>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Product Category</label>
    <input type="checkbox" name="category" value = "1" class="checkbox" > Men
    <input type="checkbox" name="category" value = "2" class="checkbox" > Women
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Brand</label>
    <input type="checkbox" name="category" value = "1" class="checkbox" > Trends
    <input type="checkbox" name="category" value = "2" class="checkbox" > Hunk
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Sku</label>
    <input type="text" class="form-control form-control-lg" name="sku" value = "{{$sku}}"required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>