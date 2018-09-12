@extends('layout')

@section('content')
    <div class="container">
        <h3>Add a Category</h3>
        <form class="form-horizontal" action="/categories" method="POST">
            {{csrf_field()}}

            <div class="form-group">
                <label for="type">Category Type</label>
                <select class="form-control" name="category_type">
                    <option value="0" selected>Super Parent...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->category_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" name="category_name" placeholder="put name...">
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
    </div>
    
@endsection