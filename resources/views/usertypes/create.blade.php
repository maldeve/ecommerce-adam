@extends('layout')

@section('content')
    <div class="container">
        <h3>Add a User Type</h3>
        <form class="form-horizontal" action="/usertypes" method="POST">
            {{csrf_field()}}

            <div class="form-group">
                <select class="form-control" name="user_type">
                    <option selected>choose user type...</option>
                    <option value="1">Buyer</option>
                    <option value="2">Seller</option>
                    <option value="3">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
    </div>
    
@endsection