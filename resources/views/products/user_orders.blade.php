@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>My Orders</h2><hr>
            @foreach ($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($order->cart->items as $item)
                                <li class="list-group-item">
                                    {{$item['item']['product_name']}} | {{$item['qty']}} Units
                                    <span class="badge">{{$item['price']}} ksh</span>
                                </li> 
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer"> 
                        <strong>Total Price: {{$order->cart->totalPrice}} ksh</strong>
                    </div> 
                </div>
            @endforeach   
        </div>
    </div> 
@endsection