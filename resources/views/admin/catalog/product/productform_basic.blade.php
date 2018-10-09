@php
    $name = $id = $desc = $short_desc= $sku = $attributeset = null;
    $attributeset_data_coll = array('' => 'Select Attribute Set');
    $category_ids = array();
    if($data){
        $id = $data ->id;
        $product_id = $data ->product_id;
        $name = $data ->name;
        $desc = $data ->desc;
        $short_desc = $data ->short_desc;
        $sku = $data ->sku;
        $status = $data ->status;
        $base_price = $data ->base_price;
        $attributeset = $data ->attribute_set_id;
        $category_ids = json_decode($data ->category_id, true);
        $diff_attr_values = $data ->diff_attr_values;
    }

    $attributesetArr = $attributeset_coll ->toarray();
        if(count($attributesetArr) > 0 ){
        foreach($attributesetArr as $attr)
            $attributeset_data_coll[$attr['id']] = ucfirst($attr['name']);
        }
@endphp

@if($id > 0)
    <input type="hidden" name="id" value = "{{$id}}" class="" />
    <input type="hidden" name="product_id" value = "{{$product_id}}" class="" />
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
    {{Form :: select( 'attributeset' , $attributeset_data_coll , $attributeset , array('id' => 'attributeset'  , 'class' => 'form-control form-control-lg' , 'required' => 'true')) }}
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Product Category</label>
    <ul style="list-style:none">
        @if(count($cat_coll) > 0)
            @foreach($cat_coll as $category )
                @php
                    $checked = false;
                    if(count($category_ids) > 0){
                        if(in_array($category ->cat_id , $category_ids)) {
                            $checked = true;
                        }
                }
                @endphp
                <li> {{ Form::checkbox('category_id[]',  $category ->cat_id , $checked , array('class' => 'form-control form-control-lg' )) }} {{ucfirst($category ->name)}}</li>
            @endforeach
            <div class="invalid-feedback">Oops, you missed this one.</div>
        @endif
    </ul>

</div>

<div class="form-group form-inline">                        
    <label for="name">Sku</label>
    <input type="text" class="form-control form-control-lg" name="sku" value = "{{$sku}}"required>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>