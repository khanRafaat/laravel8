 @extends('admin.admin_master')
@section('admin')
    <div class="py-12">

        <div class="container">
            <div class="row">

                

                <div class="col-8">
                    <div class="card">
                        <div class=" card-header">Edit Brand</div>
                        @if(session('success'))


<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif(session('danger'))


<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('danger')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

                        <div class="card-body">

                            <form action="{{  url('brand/update/'.($brands->id) )}}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                                
                                <div class="form-group">
                                    <label for="">Update Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" value="{{$brands->brand_name}}">

                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label for="">Update Brand Image</label>
                                    <input type="file" class="form-control" name="brand_image" value="{{$brands->brand_image}}">

                                    @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group " >
                                    
                                    <img src="{{ asset($brands->brand_image)}}" style="width:400px; height:200px" class="img-thumbnail">
                                    </div>

                                   <button type="submit" class="btn btn-primary">Update Brand</button>
                                
                                
                            </form>


                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    </div>

@endsection