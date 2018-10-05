@section('title', 'New Attribute Set')
@extends('admin.layout')
@section('content')
@php

@endphp

<div class="right-side product-add-form">
    <div class="page-header">        
       <h3>New Attribute Set</h3>        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/AttributeSet/New</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
    	</span>
	</div>
    <div class="wrapper">
	    
		<div class="product-form-content">
			<form class="form" role="form" action="/admin/attributeset/save" autocomplete="on" id="attributeset-form" novalidate="" method="POST" enctype="multipart/form-data">
				<div class="tab-content">			 
				  <!-- <input type="hidden" name="status" value = "1" class="checkbox" /> -->

                <div class="form-group form-inline">                        
                    <label for="name">Enable</label>
                    <input type="checkbox"  checked data-style="ios" class="form-control" value ="1" name="status" required="true">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-lg" name="name" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Select Attributes For this Attribute Set</label>
                    <ul style="list-style: none;">
                    @foreach($attribute_col as $key =>$attr)
                    <li><input type ="checkbox" name="attributes[{{$key}}]" value="{{$attr ->id}}"> {{ucfirst($attr ->name)}}
                    </li>
                    @endforeach
                </ul>
                </div>		  						 
		    	</div>
	    	</form>
    	<div>
	</div>
</div>
@endsection
