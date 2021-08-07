@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
		<div class="card card-default">

			@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
			<div class="card-header card-header-border-bottom">
				<h2>Edit Sliders</h2>
			</div>
			<div class="card-body">
			<form action="{{  url('slider/update/'.($sliders->id) )}}" method="POST" enctype="multipart/form-data">
	           @csrf
	           <input type="hidden" name="old_image" value="{{$sliders->image}}">
	<div class="form-group">
		<label for="exampleFormControlInput1">Slider Title</label>
		<input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$sliders->title }}">
		
	</div>
	
	<div class="form-group">
		<label for="exampleFormControlTextarea1">Slider Description</label>
		<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descriptison">{{$sliders->description}}</textarea>
	</div>
	<div class="form-group">
		<label for="exampleFormControlFile1">Slider Image</label>
		<input type="file"name="image"class="form-control-file" value="{{$sliders->image}}">
	</div>

	<div class="form-group " >
    <img src="{{asset($sliders->image)}}" style="width:400px; height:200px" class="img-thumbnail">
    </div>

	<div class="form-footer pt-4 pt-5 mt-4 border-top">
	<button type="submit" class="btn btn-primary btn-default">Update Slider</button>
		
	</div>
</form>
			</div>
		</div>

		

@endsection