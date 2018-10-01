@section('title', 'Attribute Set List')
@extends('admin.layout')
@section('content')

<div class="right-side" >
    <div class="page-header">        
        <h3>Attribute Set </h3>
    </div>
	<div class="wrapper">
		<table class="table table-bordered">
			<tr><th>#</th><th>id</th><th>Name</th><th>Action</th></tr>

			@foreach($collection as $set ) 
				<tr>
					<td><input type="checkbox" name="productEdit"></td>
					<td>{{$set ->id}}</td>
					<td>{{ucfirst($set ->name)}}</td>
					
					<td><button class="btn btn-success">Edit </button></td>
				</tr>
			@endforeach

		</table>
	</div>


</div>
@endsection