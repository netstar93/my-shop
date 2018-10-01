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
			<tr><th>#</th><th>id</th><th>Name</th><th>Base Price</th> <th>Attribute Set</th> <th>Special Info</th><th>Category</th><th>Seller ID</th><th>Status</th><th>Action</th></tr>

			@foreach($collection as $product )
			 @php 
			 	$diff_attr = json_decode($product->diff_attr_values,true);
			    $special_attributes = implode(",",$diff_attr);
			 @endphp
				<tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$product ->id}}</td>
					<td>{{$product ->name}}</td>
					<td> Rs.{{$product ->base_price}}</td>
					<td>{{$product ->attribute_set_id}}</td>
					<td>{{$special_attributes}}</td>
					<td>{{$product ->category_id}}</td>
					<td>{{$product ->seller_id}}</td>
					<td>{{$product ->status}}</td>
					<td><button class="btn btn-success">Edit </button></td>
				</tr>
			@endforeach

		</table>
	</div>

</div>
@endsection