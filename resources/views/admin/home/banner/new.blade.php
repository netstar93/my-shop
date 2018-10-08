@section('title', 'New Banner')
@extends('admin.layout')
@section('content')

<div class="right-side product-add-form">
    <div class="page-header">        
       <h3>New Banner</h3>        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/Banners/New</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
    	</span>
	</div>
    <div class="wrapper">
	    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
		
        <div class="product-form-content">	
            @if(isset($banner))
                {{ Form::model($banner, array('url' => '/admin/banner/save' , 'id' => 'banner-form','method' => 'post','files' =>true , 'class'=> 'form'), $banner->id) }}

            @else

            {{ Form::open(array('url' => '/admin/banner/save' , 'id' => 'banner-form','method' => 'put','files' =>true , 'class'=> 'form') ) }}
            @endif    

				<div class="tab-content">			 
				<input type="hidden" name="_method" value="PUT">
                <div class="form-group form-inline">                        
                    {{ Form ::label('Enable') }}
                    {{ Form ::radio('status',1 , array('class' => '', 'required' => true)) }} Yes
                    {{ Form ::radio('status',0) }} No
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">
                    {{ Form ::label('Name') }}
                    {{ Form::text('name',null, array('required' => true)) }}
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                   {{ Form ::label('Upload Image') }}
                   {{ Form ::file('image') }}                    
                </div>
                {{ Form ::submit('SAVE') }}
	    	</form>
    	<div>
	</div>
</div>
@endsection
