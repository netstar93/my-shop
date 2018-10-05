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
            <span class="action-new float-right col-lg-4"> <a href="/admin/product/new"><button class="btn btn-success">Add Product</button></a></span>
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>Product ID</th><th>Name</th><th>Base Price</th> <th>Attribute Set</th> <th>Special Info</th><th>Category</th><th>Seller ID</th><th>Status</th><th>Action</th></tr>

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
					<td>{{$product ->seller_id}}</td>
					<td>{{$product ->status}}</td>
					<td>
						<button class="btn btn-success iframe"  data-src="/admin/product/edit/{{$product ->product_id}}" href="javascript:;" >Edit </button>
						<button class="btn btn-error" id="deleteItem" entity="product" item_id ={{$product ->product_id}}>Delete</button>
					</td>
				</tr>
			@endforeach

		</table>

	</div>

</div>
@endsection