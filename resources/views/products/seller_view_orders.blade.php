@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>All Orders</h2><hr>
            @foreach ($orders as $order)
                <div class="panel panel-default panel-primary">
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
                        <form action='/products/complete_orders/{{$order->id}}' method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <Strong>Order Status:</Strong>
                                <select name="order_status_id">
                                    @if ($order->order_status_id == "1")
                                        <option value="{{$order->order_status_id}}">{{"Placed"}}</option>
                                        <option value="2">Completed</option>
                                    @endif
                                    @if ($order->order_status_id == "2")
                                        <option value="{{$order->order_status_id}}">{{"Completed"}}</option>
                                        <option value="1">Placed</option>
                                    @endif 
                                </select> 
                                <button type="submit" class="btn btn-success btn-sm">Complete Order</button>
                            </div>  
                        </form>
                        
                    </div> 
                </div><hr>
            @endforeach   
        </div>
    </div> 
@endsection