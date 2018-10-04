@section('title', 'New Category')
@extends('admin.layout')
@section('content')
<div class="right-side category-add-form">
    <div class="page-header">        
       <h3>New Category</h3>        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/Catalog/Category</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" id="category_save" >Save</button></span>
	    	<!-- <span class="action-btn"><button class="btn btn-error" id="savecontinue" >Save And Continue</button></span> -->
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
    	</span>
	</div>
    <div class="wrapper">
	    <div class="product-form-tabs">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#basic" role="tab" aria-controls="home">Basic</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#prices" role="tab" aria-controls="profile">Other Attributes</a>
			  </li>
			  
			</ul>
			</div>
			<div class="category-form-content">
				@if(isset($user))
				    {{ Form::model($user, ['route' => ['updateroute', $user->id], 'method' => 'patch']) }}
				@else
				    {{ Form::open(['route' => 'createroute']) }}
				@endif

				    {{ Form::text('fieldname1', Input::old('fieldname1')) }}
				    {{ Form::text('fieldname2', Input::old('fieldname2')) }}
				    {{-- More fields... --}}
				    {{ Form::submit('Save', ['name' => 'submit']) }}
				{{ Form::close() }}
	    	<div>
	</div>
</div>
@endsection
