@extends('layout')

@section('content')
    <!-- <a href="/categories/create" class="btn btn-sm btn-primary">Add Category</a> -->
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Created At</th>
                <th>Name</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        
        @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>
                @if($category->category_type > "0")
                    @foreach($categories as $parent)
                        @if($parent->id == $category->category_type)
                            {{$parent->category_name}}
                        @endif
                    @endforeach
                @endif
                @if($category->category_type == "0")
                    <i><strong>{{"Super Parent"}}</strong></i>
                @endif
                </td>              
                <td>{{$category->created_at->diffForHumans()}}</td>
                <td>{{$category->category_name}}</td>
                <td><a href="/categories/edit/{{$category->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                <td><a href="/categories/delete/{{$category->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete category?')">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection