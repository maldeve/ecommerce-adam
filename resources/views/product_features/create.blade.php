@extends('layout')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Feature</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action = "/product_features" method="POST" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Feature To: {{$product->product_name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="feature">Feature</label>
                            <select class="form-control" name="feature_id">
                                <option selected>Choose...</option>
                                @foreach ($features as $feature)
                                    <option value="{{$feature->id}}">{{$feature->feature_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Specifications</label>
                            <textarea rows="" cols="" class="form-control" name="specifications"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Feature</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(count($product->product_features))
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Feature Name</th>
                    <th>Specification</th>
                    <th>Created at</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            
            @foreach ($product->product_features as $product_feature)
                <tr>
                    <td>{{$product_feature->id}}</td>
                    <td>{{$product_feature->feature->feature_name}}</td>
                    <td>{{$product_feature->specifications}}</td>
                    <td>{{$product_feature->created_at->diffForHumans()}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$product_feature->id}}">
                        Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal{{$product_feature->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="/product_features/{{$product_feature->id}}" class="form-horizantal" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Feature</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="category">Feature</label>
                                                <select class="form-control" name="category_id" disabled>
                                                    <option>{{$product_feature->feature->feature_name}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Specifications</label>
                                                <textarea rows="" cols="" name="specifications" class="form-control">{{$product_feature->specifications}}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Update Feature</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td><a href="/product_features/{{$product_feature->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete Feature?')" >Delete</a></td>
                </tr>
            @endforeach
        </table>  
    @endif

@endsection