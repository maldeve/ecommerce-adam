@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Update a User Type</h3>
                        <form class="form-horizontal" action="/usertypes/{{$usertype->id}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <label for="type">User Type</label>
                                <input type="text" class="form-control" name="user_type" value="{{$usertype->user_type}}">
                            </div>
                            <a href="/usertypes" class="btn btn-sm btn-warning">Back</a>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection