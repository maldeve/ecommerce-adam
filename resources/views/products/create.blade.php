@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Add a Product</h4>
                        <form class="form-horizontal" action="/products" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/>
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
                                <textarea name="product_description" class="form-control" placeholder="put description..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="product_image">
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
                </div>
            </div>        
        </div>
    </div>
    
@endsection