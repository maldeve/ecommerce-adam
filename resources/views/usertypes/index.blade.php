@extends('layout')

@section('content')
    <a href="/usertypes/create" class="btn btn-sm btn-primary">Add User Type</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>User Type</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>

        @foreach ($usertypes as $usertype)
            <tr>
                <td>{{$usertype->id}}</td>
                @if($usertype->user_type == "1")
                <td>{{"Buyer"}}</td> 
                @endif
                @if($usertype->user_type == "2")
                <td>{{"Seller"}}</td>
                @endif
                @if($usertype->user_type == "3")
                <td>{{"Admin"}}</td>
                @endif              
                <td>{{$usertype->created_at->diffForHumans()}}</td>
                <td><a href="/usertypes/edit/{{$usertype->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                <td><a href="/usertypes/delete/{{$usertype->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete user type?')">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection