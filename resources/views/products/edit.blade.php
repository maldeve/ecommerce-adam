@extends('layout')

@section('content')

    @if (Auth::user()->usertype_id == "2")
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4>Edit a Product</h4>
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
                    </div>
                </div>
            </div>            
        </div>
    @endif
    
    @if (Auth::user()->usertype_id == "1")
        <!-- <div class="col d-flex justify-content-center">
            <div class="card" style="width: 25rem;" align="center">
                <img class="card-img-top" src="{{asset('/storage/images/'.$product->product_image)}}" style="width:400px; height:300px" alt="Card image cap">
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
        </div>   -->

        <div class="container">
            <br>
            <h3 class="text-center">Details</h3>
            <hr>

            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                        <article class="gallery-wrap">
                            <div class="img-big-wrap">
                                <div>
                                    <a href="#"><img src="{{asset('/storage/images/'.$product->product_image)}}"></a>
                                </div>
                            </div>
                            <!-- slider-product.// -->
                            <div class="img-small-wrap">
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                            </div>
                            <!-- slider-nav.// -->
                        </article>
                        <!-- gallery-wrap .end// -->
                    </aside>

                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3">{{$product->product_name}}</h3>

                            <p class="price-detail-wrap">
                                <span class="price h3 text-warning"> 
                                    <span class="currency">US $</span><span class="num">{{$product->product_price}}</span>
                                </span>
                            </p>
                            <!-- price-detail-wrap .// -->
                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd>
                                    <p> {{$product->product_description}} </p>
                                </dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>Category</dt>
                                <dd>{{$product->category->category_name}}</dd>
                            </dl>
                            <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Status</dt>
                                @if ($product->product_status == "1")
                                <dd>{{"In Stock"}}</dd>
                                @endif
                                @if ($product->product_status == "2")
                                <dd>{{"Out of Stock"}}</dd>
                                @endif
                            </dl>
                            <!-- item-property-hor .// -->
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <dl class="param param-inline">
                                        <dt>Color: </dt>
                                        <dd>
                                            <select class="form-control form-control-sm" style="width:70px;">
                                                <option> Blue </option>
                                                <option> Red </option>
                                                <option> Black and white </option>
                                                <option> Pink </option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <!-- item-property .// -->
                                </div>
                                <div class="col-sm-5">
                                    <dl class="param param-inline">
                                        <dt>Quantity: </dt>
                                        <dd>
                                            <select class="form-control form-control-sm" style="width:70px;">
                                                <option> 1 </option>
                                                <option> 2 </option>
                                                <option> 3 </option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <!-- item-property .// -->
                                </div>
                                <!-- col.// -->
                                <div class="col-sm-7">
                                    <dl class="param param-inline">
                                        <dt>Size: </dt>
                                        <dd>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <span class="form-check-label">SM</span>
                                                </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <span class="form-check-label">MD</span>
                                                </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <span class="form-check-label">XXL</span>
                                                </label>
                                        </dd>
                                    </dl>
                                    <!-- item-property .// -->
                                </div>
                                <!-- col.// -->
                            </div>
                            <!-- row.// -->
                            <hr>
                            <a href="/products" class="btn btn-lg btn-warning text-uppercase"> Back </a>
                            <a href="/products/add-to-cart/{{$product->id}}" class="btn btn-lg btn-outline-success text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
                        </article>
                        <!-- card-body.// -->
                    </aside>
                    <!-- col.// -->
                </div>
                <!-- row.// -->
            </div>
            <!-- card.// -->
        </div>
        <!--container.//-->   
    @endif  
    
@endsection