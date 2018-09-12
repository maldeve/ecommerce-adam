@extends('layout')

@section('content')
    <div class="container">
        <h3>Edit a Product</h3>
        <form class="form-horizontal" action="/products/{{$product->id}}" method="POST">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="form-group">
                <label for="category">Product Category</label>
                <select class="form-control" name="category_id" disabled>
                    <option>{{$product->category->category_name}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
            </div>

            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" name="product_price" value="{{$product->product_price}}">
            </div>

            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea name="product_description" cols="3" rows="3" class="form-control">{{$product->product_description}}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="product_status">
                    @if ($product->product_status == "1")
                        <option value="1">{{"In Stock"}}</option>
                        <option value="2">Out of Stock</option>
                    @endif
                    @if ($product->product_status == "2") {
                        <option value="2">{{"Out of Stock"}}</option>
                        <option value="1">In Stock</option>
                    @endif 
                </select>
            </div>

            <a href="/products" class="btn btn-sm btn-warning">Back</a>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
    
@endsection