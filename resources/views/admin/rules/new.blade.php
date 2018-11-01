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

@section('title', 'New Catalog Rule')
@extends((( $edit_mode== true) ? 'admin.layout' : 'admin.layout' ))
@section('content')
<div class="right-side admin-form">
    <div class="page-header">        
       @if($edit_mode)
            <h3>Editing <u>{{ucfirst($formData ->name)}}</u></h3>
        @else
            <h3>New Catalog Rule</h3>
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
    
	    <div class="content">
            <div class="rule-form-tabs">
                <ul class="nav nav-tabs" id="editTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-controls="home">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#conditions" role="tab" aria-controls="condition">Condition</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#action" role="tab" aria-controls="action">Action</a>
                    </li>
                </ul>
            </div>
            <!-- {{ Form::open(array('url' => '/admin/catalog_rule', 'class' =>"form pt-2 admin-form" ) ) }} -->
            {{ Form::model($data, array('url' => '/admin/catalog_rule', 'class' =>"form pt-2 admin-form",'method' => 'PUT' )) }}

                    @if($edit_mode)
                    {{Form :: hidden('id',$id)}}
                    @endif
           

			<div class="tab-content">
                <div class="tab-pane active" id="general" role="tabpanel">

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
                   <label for="name">Description</label>
                    {{Form :: textarea('desc' , '' , array('class' => 'form-control','rows' => 3, 'cols' => 5 ,'required' => true))}}
                </div>

                <div class="form-group form-inline">                        
                   <label for="name">Valid</label>
                    {{Form :: text('from' , null , array('class' => 'form-control date col-lg-2 col-xs-2','required' => true) )}}
                    {{Form :: text('to' , null , array('class' => 'form-control date col-lg-2 col-xs-2','required' => true) )}}
                </div>
                <div class="form-group form-inline">                        
                   <label for="name">Per Customer Use limit</label>
                    {{Form :: text('usage_per_customer' , '' , array('class' => 'form-control','required' => true) )}}
                </div>

                </div>

                <div class="tab-pane" id="conditions" role="tabpanel">
                    <div class="form-group form-inline">                        
                     <label for="name">Condition</label>
                     {{Form :: text('usage_per_customer' , '' , array('class' => 'form-control','required' => true) )}}
                    </div>

                </div>

                <div class="tab-pane" id="action" role="tabpanel">
                    <div class="form-group form-inline">                        
                     <label for="name">Discount Type</label>
                     {{Form :: select('discount_type' ,array('amount' => 'By Amount','percent' => 'By Percentage'),array('class' => 'form-control') )}}
                    </div>

                    <div class="form-group form-inline">                        
                     <label for="name">Amount</label>
                     {{Form :: text('discount_amount' , null , array('class' => 'form-control','required' => true) )}}
                    </div>
                </div>

            </div>
                       
               </div>
	    	{{ Form::close() }}
          </div>
    
@endsection

