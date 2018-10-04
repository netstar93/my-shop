@php
    $name = $cat_id = $status = $desc= $visibility = null;
    if($data){
        $cat_id = $data ->cat_id;
        $name = $data ->name;
        $status = $data ->status;
        $visibility = $data ->visibility;
        $desc = $data ->description;
    }
@endphp
<input type="hidden" name="cat_id" value="{{$cat_id}}" class="text"/>

<div class="form-group form-inline">                        
    <label for="name">Enable</label>
    <input type="checkbox" class="form-control form-control-lg" name="status" required>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Name</label>
    <input type="text" class="form-control form-control-lg" name="name" value="{{$name}}" required>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Show on FrontEnd</label>
    <input type="radio" class="form-control form-control-lg" value ="1" name="visibility" required="true"> Yes
    <input type="radio" class="form-control form-control-lg" value ="0" name="visibility" required="true"> No
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Description</label>
    <input type="text" class="form-control form-control-lg" name="description" value="{{$desc}}" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">URL Key</label>
    <input type="text" class="form-control form-control-lg" name="url_key">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Parent Category</label>
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="1"> Men
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="2"> Women
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="3"> Electronics
</div>