@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('cart'))
                            <div>
                                <ul class="list-group">
                                    @foreach ($products as $product)
                                        <li class="list-group-item">
                                            <span class="badge">{{$product['qty']}}</span>
                                            <strong>{{$product['item']['product_name']}}</strong>
                                            <span class="label label-success">{{$product['price']}}</span>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Remove 1 Item</a></li>
                                                    <li><a href="#">Remove All Items</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                    <strong>Total Price: {{$totalPrice}}</strong>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                    <a href="/checkout" class="btn btn-success" type="button">Check Out</a>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                    <h3>No Items in Cart!</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection