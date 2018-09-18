@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Check Out</h3>
                        <strong>Your Total: ${{$total}}</strong>
                        <form class="form-horizontal" action="/checkout" method="post" id="checkout-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="order-number">Order Number</label>
                                <input class="form-control" type="text" id="order_number" name="order_number" required>
                            </div>
                            <button class="btn btn-success" type="submit">Buy now</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection