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
        <button class="btn btn-success float-right col-lg-2" data-fancybox data-type="iframe"
                data-src="/admin/product/new" href="javascript:;">Add Product
        </button>
    </div>
	<div class="wrapper">
		<div style="overflow-y: scroll;max-height: 500px; width: 100%;">
		<table class="table table-bordered">
			<tr><th>#</th><th>Product ID</th><th>Name</th><th>Base Price</th> <th>Attribute Set</th> <th>Special Info</th><th>Category</th><th>Is Configurable</th><th>Status</th><th>Action</th></tr>

			@foreach($collection as $product )
			 @php
                    $special_attributes = "";
                    $diff_attr = json_decode($product->attribute_values,true);
                    if(is_array($diff_attr) && count($diff_attr)){
                       $special_attributes = implode(",",$diff_attr);
                    }
			 @endphp
				<tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$product ->product_id}}</td>
					<td>{{$product ->name}}</td>
					<td> Rs.{{$product ->base_price}}</td>
					<td>{{$product ->attribute_set_id}}</td>
					<td>{{$special_attributes}}</td>
					<td>{{$product ->category_id}}</td>
					<td>{{renderBoolean($product ->is_configurable,'question')}}</td>
					<td>{{renderBoolean($product ->status)}}</td>
					<td>
						<button class="btn btn-success iframe"  data-src="/admin/product/edit/{{$product ->product_id}}" href="javascript:;" >Edit </button>
						<button class="btn btn-error" id="deleteItem" entity="product" item_id ={{$product ->product_id}}>Delete</button>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
	</div>

</div>
@endsection