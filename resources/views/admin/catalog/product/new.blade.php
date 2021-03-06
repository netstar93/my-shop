@php
    $data = array();
    $edit_mode = $is_configurable = false ;
    if(isset($formData ->id)) {
        $data = $formData;
        $edit_mode = true;
        $is_configurable = $data ->is_configurable;
    }
    $product_data = ['data' => $data];

@endphp

@section('title', 'New Product')
@extends((( $edit_mode== true) ? 'admin.layout' : 'admin.layout' ))
@section('content')

<div class="right-side product-add-form">
    <div class="page-header">        
            
       @if($edit_mode) 
        <h3>Editing {{ucfirst($formData ->name)}}</h3>      
       @else
       <h3>New Product</h3>
       @endif
    
    </div>
    <div class="actions">
    	<span class="action-buttons col-lg-4 float-right btn-group-lg">
            <span class="action-btn"><button class="btn btn-success" id="save" >Save</button></span> 
            @if($edit_mode)
                {{--<span class="action-btn"><button class="btn btn-info" id="duplicate" >Duplicate</button></span>--}}
            @endif
	    	<span class="action-btn">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary">Cancel</button></a>
            </span>
    	</span>
	</div>
    <div class="wrapper">
        <div class="product-form-tabs col-lg-4 col-xs-4">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#basic" role="tab" aria-controls="home">Basic</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#prices" role="tab" aria-controls="profile">Prices</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#images" role="tab" aria-controls="profile">Images</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#other_attribute" role="tab" aria-controls="profile">Additional Attributes</a>
			  </li>
            @if($is_configurable || !$edit_mode)
              <li class="nav-item" id ="child_product_tab">
                <a class="nav-link" data-toggle="tab" href="#subproduct" role="tab" aria-controls="profile">Add Subproducts</a>
              </li>
            @endif
			</ul>
			</div>
        <div class="product-form-content col-lg-8 col-xs-8">
				<form class="form" role="form" action="/admin/product/save" autocomplete="on" id="product-form" novalidate="" method="POST" enctype="multipart/form-data">
					<div class="tab-content">			 
					  <div class="tab-pane active" id="basic" role="tabpanel">
                          @include('admin.catalog.product.productform_basic',['attributeset_coll' =>$attributeset_coll])
					  </div>
					  <div class="tab-pane" id="prices" role="tabpanel">
					  	@include('admin.catalog.product.productform_price',$product_data)
					  </div>
					  <div class="tab-pane" id="images" role="tabpanel">
					  	@include('admin.catalog.product.productform_image')
					  </div>
                      <div class="tab-pane" id="other_attribute" role="tabpanel">
                          @include('admin.catalog.product.productform_other' )
                      </div>
                      @if($is_configurable || !$edit_mode)
					  <div class="tab-pane" id="subproduct" role="tabpanel">
					  	@include('admin.catalog.product.productform_childform')
					  </div>			  		
                      @endif				 
			    	</div>
		    	</form>
	    	<div>
	</div>
</div>
@endsection


<style type="text/css">
	.nav.nav-tabs {
    float: left;
    display: block;
    margin-right: 20px;
    border-bottom:0;
    border-right: 1px solid #ddd;
    padding-right: 15px;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    background: #ccc;
}

.nav-tabs .nav-link.active {
    color: #495057;
    background-color:#007bff !important;
    border-color: transparent !important;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: 0rem!important;
    border-top-right-radius: 0rem!important;
}
.tab-content>.active {
    display: block;
    background: #007bff;
    min-height: 165px;
}
.nav.nav-tabs {
    float: left;
    display: block;
    margin-right: 20px;
    border-bottom: 0;
    border-right: 1px solid transparent;
    padding-right: 15px;
}

/*IMAGE UPLOADER*/
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 30%;
}

/*------TABS--------*/
.product-form-content .tab-pane{
	background: unset;
}
.product-form-content,.producttabs form{
	display: inline-block;
}


/*SWITCH*/


</style>