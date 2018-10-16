@php
    $name =  $cat_id = $status = $desc= $visibility = $parent_id= null;
    if($formData) {
    $data = $formData;
        $cat_id = $data ->cat_id;
        $name = $data ->name;
        $status = $data ->status;
        $visibility = $data ->visibility;
        $desc = $data ->description;
        $parent_id = $data ->parent_cat_id;
    }
@endphp
<input type="hidden" name="cat_id" value="{{$cat_id}}" class="text"/>

<div class="form-group form-inline">                        
    <label for="name">Enable</label>
    {{ Form::radio('status', '1',  $status ==1 ? true:'' , array('class' => 'form-control ' ,' required' => 'true')) }}
    Yes
    {{ Form::radio('status', '0', $status ==0 ? true:'' ,array('class' => 'form-control' ,' required' => 'true')) }}
    No
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Name</label>
    {{ Form::text('name', $name, array('class' => 'form-control' ,' required' => 'true')) }}
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Show on FrontEnd</label>
    {{ Form::radio('visibility', '1',  $visibility ==1 ? true:'' , array('class' => 'form-control' ,' required' => 'true')) }}
    Yes
    {{ Form::radio('visibility', '0', $visibility ==0 ? true:'' ,array('class' => 'form-control' ,' required' => 'true')) }}
    No
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Description</label>
    {{ Form::text('description', $desc, array('class' => 'form-control' ,' required' => 'true')) }}
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">URL Key</label>
    <input type="text" class="form-control" name="url_key">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">
    <label for="name">Category</label>
    <ul style="list-style:none">
        @foreach($cat_coll as $category )
            @php
                $checked = false;
                if($category ->id == $parent_id) {
                    $checked = true;
                }
            @endphp
            <li> {{ Form::radio('parent_cat_id',  $category ->id , $checked , array('class' => 'form-control' ,' required' => 'true')) }} {{$category ->name}}</li>
        @endforeach
    </ul>
</div>