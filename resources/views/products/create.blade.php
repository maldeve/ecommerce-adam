@extends('layout')

@section('content')
    <div class="container">
        <h3>Add a Product</h3>
        <form class="form-horizontal" action="/products" method="POST">
            {{csrf_field()}}
            <!-- <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/> -->
            <div class="form-group">
                <label for="category">Product Category</label>
                <select class="form-control" name="category_id">
                    <option selected>Choose...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->category_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="put name...">
            </div>

            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" name="product_price" placeholder="put price...">
            </div>

            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea name="product_description" cols="3" rows="3" class="form-control" placeholder="put description..."></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="product_status">
                    <option selected>Choose...</option>
                    <option value="1">In Stock</option>
                    <option value="2">Out of Stock</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
    </div>
    
@endsection