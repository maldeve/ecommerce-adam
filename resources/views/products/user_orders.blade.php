@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>My Orders</h2><hr>
            @foreach ($orders as $order)
                <div class="panel panel-default">
                    <strong>Order Number: {{$order->order_number}}</strong>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($order->cart->items as $item)
                            <li class="list-group-item">
                                <span class="badge">Product:</span> {{$item['item']['product_name']}} | 
                                <span class="badge">Units:</span> {{$item['qty']}} | 
                                <span class="badge">Price:</span> {{$item['price']}} ksh
                            </li> 
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer"> 
                        <strong>Total Price: {{$order->cart->totalPrice}} ksh</strong>
                        <div class="form-group">
                            <Strong>Order Status:</Strong>
                            @if ($order->order_status_id == "1")
                                <span class="badge">Placed</span>
                            @endif
                            @if ($order->order_status_id == "2")
                                <span class="badge">Completed</span>
                            @endif 
                        </div>
                    </div> 
                </div><hr>
            @endforeach   
        </div>
    </div> 
@endsection