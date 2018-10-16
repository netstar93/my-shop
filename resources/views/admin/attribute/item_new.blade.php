@php
$edit_mode = false;
$id = $name = $wrapper_class =$type=  null;
$status = true;
$data = $options = array();
$edit_mode = false;
if(isset($formData ->id)) {
    $data = $formData;
    $edit_mode = true;
    $id= $formData ->id;
    $name = $data  ->name;
    $status = $data  ->status;
    $type = $data  ->type;
    if(!empty($data ->options)) {
        $options = json_decode($data ->options,true);
    }
}

$is_disable = $edit_mode == true ? 'pointer-events:none' : '';
@endphp

@section('title', 'New Attribute')

@extends((( $edit_mode== true) ? 'admin.layout' : 'admin.layout' ))

@section('content')
<div class="right-side admin-form">
    <div class="page-header">        
       @if($edit_mode)
            <h3>Editing {{ucfirst($formData ->name)}}</h3>
        @else
            <h3>New Attribute</h3>
        @endif        
    </div>
    <div class="actions">    	
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button type="submit" class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary">Cancel</button></a>
            </span>            
    	</span>
	 </div>
     <hr>
	    <div class="content ">
			<form class="form" role="form" action="/admin/attribute/save" id="attribute-form" novalidate="" method="POST" enctype="multipart/form-data">
				
        @if($edit_mode)
        {{Form :: hidden('id',$id)}}
        @endif
                <div class="form-group form-inline">
                     {{ Form ::label('Enable') }}
                    {{ Form::radio('status', '1',  $status ==1 ? true:'' , array('class' => 'form-control status-radio' ,' required' => 'true')) }}
                    Yes
                    {{ Form::radio('status', '0', $status ==0 ? true:'' ,array('class' => 'form-control status-radio' ,' required' => 'true')) }}
                    No
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{$name}}"name="name" required>
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>


                <div class="form-group form-inline">                        
                   <label for="name">Type</label>

                {{ Form::select('size', ['text' => 'TextBox', 'boolean' => 'Yes/No' , 'checkbox' => 'checkbox' ,'select' => 'Dropdown'], $type, ['name' => 'type' , 'id' => 'attr_type' ,'required' =>'' , 'style' => $is_disable ] )  }}

                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
<hr>
                <div class="form-group form-inline selectContent">   
                    <span class="action-btn">
                        <button class="btn btn-info btn-sm" id= "addOption">Add Option</button>
                    </span> 
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
                            </span>
                        </div>
                     @endif
                    </div>
                    </div>
	    	</form>
          </div>
    
@endsection
