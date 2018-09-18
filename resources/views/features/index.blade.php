@extends('layout')

@section('content')
    <a href="/features/create" class="btn btn-sm btn-primary">Add Feature</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Feature</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        @foreach ($features as $feature)
            @if ($feature->user_id == Auth::user()->id)
                <tr>
                    <td>{{$feature->id}}</td>
                    <td>{{$feature->feature_name}}</td>
                    <td>{{$feature->created_at->diffForHumans()}}</td>
                    <td><a href="/features/edit/{{$feature->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                    <td><a href="/features/delete/{{$feature->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete Feature?')">Delete</a></td>
                </tr>
            @endif 
        @endforeach
    </table>    
@endsection