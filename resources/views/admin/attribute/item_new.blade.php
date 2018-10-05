@php
$edit_mode = false;
$id = $name = $wrapper_class =$type=  null;
$data = $options = array();
$edit_mode = false;
if(isset($formData ->id)) {
    $data = $formData;
    $edit_mode = true;
    $id= $formData ->id;
    $name = $data  ->name;
    $type = $data  ->type;
    if(!empty($data ->options)) {
        $options = json_decode($data ->options,true);
    }
}
@endphp

@section('title', 'New Attribute')

@extends((( $edit_mode== true) ? 'admin.modal_layout' : 'admin.layout' ))

@section('content')
<div class="right-side product-add-form">
    <div class="page-header">        
       @if($edit_mode)
            <h3>Editing {{ucfirst($formData ->name)}}</h3>
        @else
            <h3>New Attribute</h3>
        @endif        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/Attribute/New</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button type="submit" class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
            <span class="action-btn"><button class="btn btn-warning" id= "addOption">Add Option</button></span>
    	</span>
	 </div>
     
    <div class="form-wrapper">
	    <div class="container form-content ">
			<form class="form" role="form" action="/admin/attribute/save" id="attribute-form" novalidate="" method="POST" enctype="multipart/form-data">
				
        @if($edit_mode)
        {{Form :: hidden('id',$id)}}
        @endif
                <div class="form-group form-inline">                        
                    <label for="name">Enable</label>
                    <input type="checkbox" checked data-style="ios" class="form-control required" value ="1" name="status" required="true">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-lg" value="{{$name}}"name="name" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>


                <div class="form-group form-inline">                        
                   <label for="name">Type</label>

                {{ Form::select('size', ['text' => 'TextBox', 'boolean' => 'Yes/No' , 'checkbox' => 'checkbox' ,'select' => 'Dropdown'], $type, ['name' => 'type' , 'id' => 'attr_type' ,'required' =>''] )  }}

                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline selectContent" style="display: ncone">   

                    <div class="optionValues" id="selectOptions" total = {{count($options)}}>    
                     @if(count($options) > 0)                       
                        
                        @foreach($options as $key => $option)      
                          <div class="value"> 
                            <span>Value {{$key + 1  }}</span>
                                {!! Form::text("select_option[$key]", $option , array()) !!} 
                                <i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
                            </span>
                          </div>
                        @endforeach

                        @else
                         <div class="value">
                            <span>Value 1</span>{{ Form::text('select_option[0]', null , array()) }} <span>
                                <i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
                            </span></div>
                     @endif
                    </div>

                </div>	
	    	</form>
            </div>
    	<div>
	</div>
@endsection

<script>

</script>