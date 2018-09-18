@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Update a Category</h3>
                        <form class="form-horizontal" action="/categories/{{$category->id}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <label for="type">Category Type</label>
                                <input type="text" class="form-control" name="category_type" value="{{$category->category_type}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
                            </div>
                            <a href="/categories" class="btn btn-sm btn-warning">Back</a>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
@endsection