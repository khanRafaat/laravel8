@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Create Contact</h2>
			</div>
			<div class="card-body">
			<form action="{{url('admin/update/contact/'.($getdata->id))}}" method="POST">
	           @csrf
	<div class="form-group">
		<label for="exampleFormControlInput1">Contact Email</label>
		<input type="email" name="email" class="form-control" id="" placeholder=" Contact Email" value="{{$getdata->email}}">
		
	</div>
	  
	<div class="form-group">
		<label for="exampleFormControlInput1">Contact Phone</label>
		<input type="text" name="phone" class="form-control" id="" placeholder=" Contact Phone" value="{{$getdata->phone}}">
		
	</div>
	  
	

	<div class="form-group">
		<label for="exampleFormControlTextarea">Contact Address</label>
		<textarea class="form-control" id="exampleFormControlTextarea" rows="3" name="address" placeholder="Contact Address">{{$getdata->address}}</textarea>
	</div>
	
	<div class="form-footer pt-4 pt-5 mt-4 border-top">
	<button type="submit" class="btn btn-primary btn-default">Submit</button>
		
	</div>
</form>
			</div>
		</div>

		

@endsection