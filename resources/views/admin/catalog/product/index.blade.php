@section('title', 'Product List')
@extends('admin.layout')
@section('content')
<div class="right-side" >
    <div class="page-header">        
        <h3>Product Page </h3>
    </div>
    <div class="action-bar">
            <span class="mass-action float-left col-lg-8">
                <select class="dropdown">
                    <option value="-">---SELECT---</option>
                    <option value="delete">Delete</option>
                    <option value="delete">Disable</option>
                </select>
            </span>
	        <!-- <button class="btn btn-success" data-fancybox data-type="iframe"
	                data-src="/admin/product/new" href="javascript:;"><i class="fa fa-plus" aria-hidden="true"></i> Add
	        </button> -->
	        <span class="add-new">
	       		<a href="/admin/product/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
	        </span>
    </div>

	<div class="wrapper">
		<div style="overflow: scroll;max-height: 600px; width: 100%;">
		<table class="table table-bordered">
			<tr><th>#</th><th>ID</th><th>Image</th> <th>Name</th><th>Base Price</th> <th>Attribute Set</th><th>Category</th><th>Is Configurable</th><th>Status</th><th>Action</th></tr>

			@foreach($collection as $product )
			 @php
                    $special_attributes = $image = "";
                    $diff_attr = json_decode($product->attribute_values,true);
                    if(is_array($diff_attr) && count($diff_attr)){
                       $special_attributes = implode(",",$diff_attr);
                    }

                    if(isset($product ->image)){
						$image = url('media/product/thumb')."/".$product ->image;
                	}
			 @endphp
			     <tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$product ->product_id}}</td>
					<td> <img src={{$image}} style=" max-width: 50px;"/> </td>
					<td>{{$product ->name}}</td>
					<td> {{renderPrice($product ->base_price)}}</td>
					<td>{{$product ->attribute_set_id}}</td>
					<td>{{$product ->category_id}}</td>
					<td>{{renderBoolean($product ->is_configurable,'question')}}</td>
					<td>{{renderBoolean($product ->status)}}</td>
					<td>
						<a href="/admin/product/edit/{{$product ->product_id}}">
							<button class="btn btn-success btn-responsive"> 
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						</a>
                        <button class="btn btn-responsive btn-danger" id="deleteItem" entity="product"
                                item_id={{$product ->product_id}}><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        
					</td>
				</tr>
			@endforeach
		</table>
	</div>
	</div>

</div>
@endsection