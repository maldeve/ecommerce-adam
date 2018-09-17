@extends('layout')

@section('content')

    @if (Auth::user()->usertype_id == "2")
        <div class="container">
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
    @endif
    
    @if (Auth::user()->usertype_id == "1")
        <div class="col d-flex justify-content-center">
            <div class="card" style="width: 25rem;" align="center">
                <img class="card-img-top" src="/imgs/wine.jpg" style="width:400px; height:300px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-header">Features</h5>
                    <table class="table">
                        <tr>
                            <th>Feature</th>
                            <th>Specifications</th>
                        </tr>                       
                        @foreach ($product->product_features as $product_feature)
                            <tr>
                                <td>{{$product_feature->feature->feature_name}}</td>
                                <td>{{$product_feature->specifications}}</td>
                            </tr>
                        @endforeach                       
                    </table>
                </div>
                <div class="card-body" align="center">
                    <a href="/products" class="btn btn-sm btn-warning">Back</a>
                    <a href="/products/add-to-cart/{{$product->id}}" class="btn btn-sm btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>     
    @endif  
    
@endsection