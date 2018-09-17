@extends('layout')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h2>Check Out</h2>
            <p>Your Total: ${{$total}}</p>
            <form action="/checkout" method="post" id="checkout-form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="order-number">Order Number</label>
                            <input class="form-control" type="text" id="order_number" name="order_number" required>
                        </div>
                    </div> 
                </div>
                <button class="btn btn-success" type="submit">Buy now</button> 
            </form>
        </div>
    </div>
@endsection