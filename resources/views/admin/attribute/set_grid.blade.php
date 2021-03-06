@section('title', 'Attribute Set List')
@extends('admin.layout')
@section('content')

<div class="right-side" >
    <div class="page-header">        
        <h3>Attribute Set </h3>
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
                    <a href="/admin/attributeset/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
            </span>
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>id</th><th>Name</th><th>Action</th></tr>

			@foreach($collection as $set ) 
				<tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$set ->id}}</td>
					<td>{{ucfirst($set ->name)}}</td>
					
					<td>
                        <a href="/admin/attributeset/edit/{{$set ->id}}">
                            <button class="btn btn-success btn-responsive"> 
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </a>
                        <button class="btn btn-responsive btn-danger" id="deleteItem" entity="attributeset"
                                item_id={{$set ->id}}><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
					</td>
				</tr>
			@endforeach

		</table>
	</div>


</div>
@endsection