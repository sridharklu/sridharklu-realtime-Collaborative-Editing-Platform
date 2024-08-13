@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-lg-12 margin-tb mb-4">
          <div class="pull-left">
              <h2>Users Management                
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                </div>
              </h2>
          </div>
      </div>
  </div>


  @if ($message = Session::get('success'))
  <div class="alert alert-success my-2">
    <p>{{ $message }}</p>
  </div>
  @endif


  <table class="table table-bordered table-hover table-striped">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Roles</th>
      <th width="280px">Action</th>
    </tr>
    @foreach ($data as $key => $user)
     <tr>
       <td>{{ $user->name }}</td>
       <td>{{ $user->email }}</td>
       <td>
         @if($user->getRoleNames()->isNotEmpty())
            @foreach($user->getRoleNames() as $role)
                <label class="badge badge-secondary text-dark">{{ $role }}</label>
            @endforeach
         @endif

       </td>
       <td>
          <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
          <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-success">Delete</button>
          </form>
           {{-- <a class="btn btn-success" href="{{ route('users.destroy',$user->id) }}"> Delete</a> --}}
           
       </td>
     </tr>
    @endforeach
   </table>
</div>

@endsection 