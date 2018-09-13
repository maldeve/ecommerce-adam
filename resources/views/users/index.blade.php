@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>User Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th colspan="1">Actions</th>
                    </tr>
                </thead>
                
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        @if($user->usertype_id == "1")
                        <td>{{"Buyer"}}</td> 
                        @endif
                        @if($user->usertype_id == "2")
                        <td>{{"Seller"}}</td>
                        @endif
                        @if($user->usertype_id == "3")
                        <td>{{"Admin"}}</td>
                        @endif
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td><a href="/users/delete/{{$user->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete User?')">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    
@endsection