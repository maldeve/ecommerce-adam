@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Add a Feature</h3>
                        <form class="form-horizontal" action="/features" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/>

                            <div class="form-group">
                                <label for="name">Feature Name</label>
                                <input type="text" class="form-control" name="feature_name" placeholder="put name...">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection