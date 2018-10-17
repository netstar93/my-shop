@php
    $name = $id = $desc = $short_desc= $sku = $attributeset = $unclick =  null;
    $status = true;
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
        $unclick = "pointer-events:none";
    }

    $attributesetArr = $attributeset_coll ->toarray();
        if(count($attributesetArr) > 0 ){
        foreach($attributesetArr as $attr)
            $attributeset_data_coll[$attr['id']] = ucfirst($attr['name']);
        }
@endphp

@if($id > 0)    
    <input type="hidden" name="id" value = "{{$id}}" class="" />
    <input type="hidden" id="product_id" name="product_id" value="{{$product_id}}" class=""/>
@endif

<div class="form-group form-inline">
    {{ Form ::label('Enable') }}
    {{ Form::radio('status', '1',  $status ==1 ? true:'' , array('class' => 'form-control' ,' required' => 'true')) }}
    Yes
    {{ Form::radio('status', '0', $status ==0 ? true:'' ,array('class' => 'form-control' ,' required' => 'true')) }}
    No
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name" class="col-lg-4">Name</label>
    <input type="text" class="form-control" value = "{{ $name}}" name="name" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description" class="col-lg-4">Description</label>
    <input type="textarea" class="form-control" name="description" value = "{{ $desc}}" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description" class="col-lg-4">Short Description</label>
    <input type="textarea" class="form-control" name="short_description" value="{{$short_desc}}" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline" style="{{$unclick}}">                        
    <label for="description" class="col-lg-4">Product Attribute Set</label>
    {{Form :: select( 'attributeset' , $attributeset_data_coll , $attributeset , array('id' => 'attributeset'  , 'class' => 'form-control' , 'required' => 'true')) }}
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label class="col-lg-4" for="description">Product Category</label>
    <ul style="list-style:none" class="form-control">
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
                <li class="col-lg-4" style="padding: 0px;"> {{ Form::checkbox('category_id[]',  $category ->cat_id , $checked , array('class' => 'form-control-checkbox' )) }} <span>{{ucfirst($category ->name)}}</span></li>
            @endforeach
            <div class="invalid-feedback">Oops, you missed this one.</div>
        @endif
    </ul>

</div>

<div class="form-group form-inline">                        
    <label for="name" class="col-lg-4">Sku</label>
    <input type="text" class="form-control" name="sku" value = "{{$sku}}"required>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>