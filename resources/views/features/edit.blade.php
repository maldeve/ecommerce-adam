@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Edit a Feature</h3>
                        <form class="form-horizontal" action="/features/{{$feature->id}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="form-group">
                                <label for="name">Feature Name</label>
                                <input type="text" class="form-control" name="feature_name" value="{{$feature->feature_name}}">
                            </div>

                            <a href="/features" class="btn btn-sm btn-warning">Back</a>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection