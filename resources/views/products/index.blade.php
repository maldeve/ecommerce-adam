@extends('layout')

@section('content')
    @if (Auth::user()->usertype_id == "2")
        <div class="row">
            <div class="col-md-10">
                <a href="/products/create" class="btn btn-sm btn-primary">Add Product</a>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>

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
                            <td><a href="/product_features/{{$product->id}}" class="btn btn-sm btn-success">Product Features</a></td>
                            <td><a href="/products/delete/{{$product->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete Product?')">Delete</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif 
    
    @if (Auth::user()->usertype_id == "1")
        <div class="row">
            <div class="col-md-10">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>

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
                            <td>{{$product->created_at->diffForHumans()}}</td>
                            <td><a href="/products/edit/{{$product->id}}" class="btn btn-sm btn-primary">View</a></td>
                            <td><a href="/products/add-to-cart/{{$product->id}}" class="btn btn-sm btn-success">Add to Cart</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
      
@endsection