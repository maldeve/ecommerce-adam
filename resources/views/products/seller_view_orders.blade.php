@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-body">
                    <h2>All Orders</h2><hr>
                    @foreach ($order_items as $order_item)
                        @if ($order_item->seller == Auth::user()->id)
                            <div class="panel panel-default panel-primary">
                                <strong>Order Id: {{$order_item->order_id}}</strong>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="badge">Product:</span> {{$order_item->product_id}} | 
                                            <span class="badge">Units:</span> {{$order_item->quantity}} | 
                                            <span class="badge">Price:</span> {{$order_item->price}} $
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <form action='/products/complete_orders/{{$order_item->id}}' method="post">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}
                                        <div class="form-group">
                                            <Strong>Order Status:</Strong>
                                            <select name="order_item_status">
                                                @if ($order_item->order_item_status == "1")
                                                    <option value="{{$order_item->order_item_status}}">{{"Placed"}}</option>
                                                    <option value="2">Completed</option>
                                                @endif
                                                @if ($order_item->order_item_status == "2")
                                                    <option value="{{$order_item->order_item_status}}">{{"Completed"}}</option>
                                                    <option value="1">Placed</option>
                                                @endif 
                                            </select> 
                                            <button type="submit" class="btn btn-success btn-sm">Complete Order</button>
                                        </div>  
                                    </form>                        
                                </div> 
                            </div><hr>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div> 
@endsection