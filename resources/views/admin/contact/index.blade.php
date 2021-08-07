@extends('admin.admin_master')

@section('admin')

    <div class="py-12"> 
   <div class="container">
    <div class="row">


  



    <div class="col-md-12">
     <div class="card">
     <a class="text-right" href="{{ route('add.contact') }}"> <button class="btn btn-info">Add Contact</button>  </a>
  <div class="card-header"> All Contact Data </div>
    

    <table class="table">
  <thead>
    <tr>
      <th scope="col" width="5%" height="5%">SL </th>
      <th scope="col" width="15%" height="5%">Contact Email</th>
      <th scope="col" width="15%" height="5">Contact Phone</th>
      <th scope="col" width="25%" height="5%">Contact Address</th>
        <th scope="col" width="25%" height="5%">Created At</th>
      <th scope="col" width="15%" height="5%">Action</th>
    </tr>
  </thead>
  <tbody>
          @php($i = 1)
        @foreach($contacts as $con) 
    <tr>
      <th scope="row"> {{ $i++  }} </th>
      <td>{{$con->email}}</td>
      <td>{{$con->phone}}</td>
      <td>{{$con->address}}</td> 
      <td>{{$con->created_at->diffForhumans()}}</td> 
       
       <td> 
       <a href="{{ url('contact/edit/'.$con->id) }}" class="btn btn-info">Edit</a>
       <a href="{{ url('contact/delete/'.$con->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
        </td> 


    </tr> 
    @endforeach


  </tbody>
</table>
 
  
       </div>
    </div>

 


    </div>
  </div> 

 


    </div>
 @endsection
