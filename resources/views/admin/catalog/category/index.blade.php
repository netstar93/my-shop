@section('title', 'Category List')
@extends('admin.layout')
@section('content')
<div class="right-side" >
    <div class="page-header">        
        <h3>Category Page </h3>
    </div>
    <div class="action-bar">
            <span class="mass-action float-left col-lg-8">
                <select class="dropdown">
                    <option value="-">---SELECT---</option>
                    <option value="delete">Delete</option>
                    <option value="delete">Disable</option>
                </select>
            </span>
        	<span class="add-new">
	       		<a href="/admin/category/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
	        </span>
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>ID</th><th>Name</th><th>Parent Category</th><th>Visibility</th><th>Status</th><th>Action</th></tr>

			@foreach($collection as $category ) 
				<tr>
					<td><input type="checkbox" name="categoryEdit"></td>
					<td>{{$category ->cat_id}}</td>
					<td>{{ucfirst($category ->name)}}</td>
                    <td>{{ucfirst($category ->parent_cat_id)}}</td>
					<td>{{$category ->visibility}}</td>
					<td>{{renderBoolean($category ->status)}}</td>					
					<td>
						<a href="/admin/category/edit/{{$category ->cat_id}}">
							<button class="btn btn-success btn-responsive"> 
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						</a>
						<button class="btn btn-responsive btn-danger" id="deleteItem" entity="category"
                                item_id={{$category ->cat_id}}><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
					</td>
				</tr>
			@endforeach

		</table>
	</div>

</div>
@endsection