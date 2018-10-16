@section('title', 'New Banner')
@extends('admin.layout')
@section('content')

<div class="right-side admin-form">
    <div class="page-header">        
       <h3>New Banner</h3>        
    </div>
    <div class="actions">    	
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary">Cancel</button></a>
            </span>
    	</span>
	</div>
    <hr>
    <div class="content">
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
		
        <div class="data">	
            @if(isset($banner))
                {{--{{ Form::model($banner, array('url' => '/admin/banner/update' , 'id' => 'banner-form','method' => 'put','files' =>true , 'class'=> 'form'), $banner->id) }}--}}

                {{ Form::model($banner, ['route' => ['banner.update', $banner->id]  , 'method' => 'post' ]) }}
                                {{ method_field('PATCH') }}
            @else
                {{ Form::open(array('url' => '/admin/banner/save' , 'id' => 'banner-form','method' => 'post','files' =>true , 'class'=> 'form') ) }}
            @endif    

				<div class="tab-content">
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
                    {{ Form ::file('image' , null ,array('required' => true)) }}
                </div>                    
                    {!!Form::close()!!}
    	<div>
	</div>
</div>
@endsection
