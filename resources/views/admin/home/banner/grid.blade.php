@section('title', 'Banner List')
@extends('admin.layout')
@section('content')

<div class="right-side" >
    <div class="page-header">        
        <h3>Banner List</h3>
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
	       		<a href="/admin/banner/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
	        </span>	
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>id</th><th>Name</th><th>Image</th><th>Status</th><th>Actions</th></tr>

			@foreach($collection as $banner ) 
			@php
				$path  = url("media/banners/");
				$image_path  = $path."/".$banner ->path;
			@endphp
				<tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$banner ->id}}</td>
					<td>{{$banner ->name}}</td>					
					<td><img src="{{ $image_path }}" width="90px"/></td>
					<td>{{$banner ->status}}</td>
					<td>
						<a href="/admin/banner/{{$banner ->id}}/edit">
							<button class="btn btn-success btn-responsive"> 
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</button>
						</a>
                        <button class="btn btn-responsive btn-danger" id="deleteItem" entity="banner"
                                item_id={{$banner ->id}}><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>					
					</td>
				</tr>
			@endforeach

		</table>
	</div>


</div>
@endsection