@extends('layout')

@section('content')
    <a href="/usertypes/create" class="btn btn-sm btn-primary">Add User Type</a>
    <table class="table table-condensed table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>User Type</th>
            <th>Created At</th>
            <th colspan="2">Actions</th>
        </tr>

        @foreach ($usertypes as $usertype)
            <tr>
                <td>{{$usertype->id}}</td>
                <td>
                @foreach($usertypes as $parent)
                    @if($parent->id == "1")
                        {{"Buyer"}}
                    @endif
                    @if($parent->id == "2")
                        {{"Seller"}}
                    @endif
                    @if($parent->id == "3")
                        {{"Admin"}}
                    @endif
                @endforeach
                </td>              
                <td>{{$usertype->created_at->diffForHumans()}}</td>
                <td><a href="/usertypes/edit/{{$usertype->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                <td><a href="/usertypes/delete/{{$usertype->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete user type?')">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection