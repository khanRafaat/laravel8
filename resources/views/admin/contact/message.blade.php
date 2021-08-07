@extends('admin.admin_master')

@section('admin')

    <div class="py-12"> 
   <div class="container">
    <div class="row">
<div class="col-md-12">
 <div class="card">


   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('success') }}</strong>  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
   </div>
   @endif


          <div class="card-header"> All Contact Message Data </div>
    

    <table class="table">
  <thead>
    <tr>
      <th scope="col" width="5%">SL </th>
      <th scope="col" width="10%" >Name</th>
      <th scope="col" width="10%">Email</th>
      <th scope="col" width="10%" >Subject</th>
      <th scope="col" width="20%">Message</th>
      <th scope="col" width="10%" >Created At</th>
      <th scope="col" width="10%" >Action</th>
    </tr>
  </thead>
  <tbody>
          @php($i = 1)
        @foreach($messages as $msg) 
    <tr>
      <th scope="row"> {{ $i++  }} </th>
      <td>{{$msg->name}}</td>
      <td>{{$msg->email}}</td>
      <td>{{$msg->subject}}</td> 
      <td>{{$msg->message}}</td> 
      <td>{{$msg->created_at->diffForhumans()}}</td> 
       
       <td> 
       <a href="{{ url('message/delete/'.$msg->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
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
