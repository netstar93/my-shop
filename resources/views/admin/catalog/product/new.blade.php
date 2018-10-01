@section('title', 'New Product')
@extends('admin.layout')
@section('content')
<div class="right-side product-add-form">
    <div class="page-header">        
       <h3>New Product</h3>        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/Catalog/Product</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button class="btn btn-success" id="save" >Save</button></span>
	    	<span class="action-btn"><button class="btn btn-error" id="savecontinue" >Save And Continue</button></span>
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
			    <a class="nav-link" data-toggle="tab" href="#prices" role="tab" aria-controls="profile">Prices</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#images" role="tab" aria-controls="profile">Images</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#other" role="tab" aria-controls="profile">Other Attributes</a>
			  </li>
			</ul>
			</div>
			<div class="product-form-content">
				<form class="form" role="form" action="/admin/product/save" autocomplete="on" id="product-form" novalidate="" method="POST" enctype="multipart/form-data">
					<div class="tab-content">			 
					  <div class="tab-pane active" id="basic" role="tabpanel">
					  	@include('admin.catalog.product.productform_basic')
					  </div>
					  <div class="tab-pane" id="prices" role="tabpanel">
					  	@include('admin.catalog.product.productform_price')
					  </div>
					  <div class="tab-pane" id="images" role="tabpanel">
					  	@include('admin.catalog.product.productform_image')
					  </div>
					  <div class="tab-pane" id="other" role="tabpanel">
					  	@include('admin.catalog.product.productform_other')
					  </div>			  						 
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