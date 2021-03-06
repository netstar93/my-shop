@php
    $data = array();
    $edit_mode = false;
    if(isset($formData ->cat_id)) {
        $data = $formData;
        $edit_mode = true;
    }
    $data = ['data' => $data];
@endphp
@section('title', 'New Category')
@extends((( $edit_mode== true) ? 'admin.layout' : 'admin.layout' ))
@section('content')
<div class="right-side admin-form">
    <div class="page-header">
        @if($edit_mode)
            <h3>Editing {{ucfirst($formData ->name)}}</h3>
        @else
            <h3>New Category</h3>
        @endif
    </div>
    <div class="actions">
        <span class="action-buttons btn-group-lg">
	    	<span class="action-btn"><button class="btn btn-success" id="save" type="submit">Save</button></span>
	    	<span class="action-btn">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary">Cancel</button></a>
            </span>
    	</span>
    </div>
    <hr>
    <div class="wrapper">
        <div class="product-form-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#basic" role="tab" aria-controls="home">Basic</a>
                </li>
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" data-toggle="tab" href="#prices" role="tab" aria-controls="profile">Other Attributes</a>--}}
                {{--</li>--}}
            </ul>
        </div>
        <div class="content">
            <form class="form" role="form" action="/admin/category/save" autocomplete="on" id="category-form"
                  novalidate="" method="POST" enctype="multipart/form-data">
                <div class="tab-content">
                    <div class="tab-pane active" id="basic" role="tabpanel">
                        @include('admin.catalog.category.categoryform_basic',['data' =>$data , 'cat_coll' => $cat_coll])
                    </div>

                    <div class="tab-pane" id="cat_others" role="tabpanel">
                        @include('admin.catalog.category.categoryform_other',$data)
                    </div>

                </div>
                <input type="submit" name="submit_cate_form" id="category_form_button" style="display:none;"/>
            </form>

            <div>
            </div>
</div>
@endsection
