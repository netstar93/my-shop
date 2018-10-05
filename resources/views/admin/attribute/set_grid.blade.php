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
            <span class="action-new float-right col-lg-4"> <a href="/admin/attributeset/new"><button class="btn btn-success">Add Attributeset</button></a></span>
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
						<button class="btn btn-success" data-fancybox data-type="iframe" data-src="/admin/attributeset/edit/{{$set ->id}}" href="javascript:;" >Edit </button>	
						<button class="btn btn-error" id="deleteItem" entity="attributeset" item_id ="{{$set ->id}}" disable>Remove</button>					
					</td>
				</tr>
			@endforeach

		</table>
	</div>


</div>
@endsection