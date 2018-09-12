@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <a href="/products/create" class="btn btn-sm btn-primary">Add Product</a>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="4">Actions</th>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->category->category_name}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_description}}</td>
                        @if ($product->product_status == "1")
                            <td>{{"In Stock"}}</td>
                        @endif
                        @if ($product->product_status == "2")
                            <td>{{"Out of Stock"}}</td>
                        @endif
                        <td>{{$product->created_at->toFormattedDateString()}}</td>
                        <td><a href="/products/edit/{{$product->id}}" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="#" class="btn btn-sm btn-success">Add to Cart</a></td>
                        <td><a href="/products/delete/{{$product->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete Product?')">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    
@endsection