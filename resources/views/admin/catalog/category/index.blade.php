@section('title', 'Category List')
@extends('admin.layout')
@section('content')
<div class="right-side" >
    <div class="page-header">        
        <h3>Category Page </h3>
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>ID</th><th>Name</th><th>Parent Category</th><th>Visibility</th><th>Status</th><th>Action</th></tr>

			@foreach($collection as $category ) 
				<tr>
					<td><input type="checkbox" name="categoryEdit"></td>
					<td>{{$category ->cat_id}}</td>
					<td>{{ucfirst($category ->name)}}</td>					
					<td>{{ucfirst($category ->parent_category_id)}}</td>
					<td>{{$category ->visibility}}</td>
					<td>{{$category ->status}}</td>					
					<td><button class="btn btn-success">Edit </button></td>
				</tr>
			@endforeach

		</table>
	</div>

</div>
@endsection