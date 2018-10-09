@php
    $edit_mode = false;
    $id = $name = $type=  $status = null;
    $data = $attributes = array();
    $edit_mode = false;
    if(isset($formData ->id)) {
        $data = $formData;
        $edit_mode = false;
        $id= $formData ->id;
        $name = $data  ->name;
        $status = $data  ->status;
        $attributes = explode(",",$data  ->attribute_ids);
    }
@endphp
@section('title', 'New Attribute Set')
@extends((( $edit_mode== true) ? 'admin.modal_layout' : 'admin.modal_layout' ))
@section('content')

<div class="right-side product-add-form">
    <div class="page-header">
        @if($id >0 )
            <h3>Editing {{ucfirst($formData ->name)}}</h3>
        @else
            <h3>New Attribute Set</h3>
        @endif
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/AttributeSet/New</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" type="submit" id="save">Save</button></span>
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
    	</span>
	</div>
    <div class="wrapper">
	    <a href ="{{ URL::previous() }} ">  Back </a>
		<div class="product-form-content">
            <form class="form" role="form" action="/admin/attributeset/save" id="attributeset-form" novalidate=""
                  method="POST" enctype="multipart/form-data">
                @if($id >0 )
                    {{Form :: hidden('id',$id)}}
                @endif
                <div class="tab-content">

                <div class="form-group form-inline">                        
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-lg" value="{{$name}}" name="name" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Select Attributes For this Attribute Set</label>
                    <ul style="list-style: none;">
                    @foreach($attribute_col as $key =>$attr)
                            @php
                                $selected = '';
                                if(count($attributes) > 0) {
                                    if(in_array($attr ->id,$attributes)) {
                                     $selected  = "checked";
                                     }
                                }
                            @endphp
                            <li><input type="checkbox" name="attribute_ids[{{$key}}]"
                                       value="{{$attr ->id}}" {{$selected}}> {{ucfirst($attr ->name)}} </li>
                    @endforeach
                </ul>
                </div>		  						 
		    	</div>
              <!--   <input type="submit" value="submit"/> -->
	    	</form>
    	<div>
	</div>
        </div>
</div>
@endsection
