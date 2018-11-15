<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="/css/custom.css">
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                  <div class="card-header">Edit Buckets Information</div>
                  <div class="card-body">
                     <form  action="/bucket/{{$bucket->id}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="bucket_name" value="{{$bucket->bucket_name}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="bucket_name" value="{{$bucket->bucket_name}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="district" value="{{$bucket->district}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="bs_name" value="{{$bucket->bs_name}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="equipment" value="{{$bucket->equipment}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="client_type" value="{{$bucket->client_type}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="first_name" value="{{$bucket->first_name}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="second_name" value="{{$bucket->second_name}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="address" value="{{$bucket->address}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="equipment1" value="{{$bucket->equipment1}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="ip_address" value="{{$bucket->ip_address}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="latitude" value="{{$bucket->latitude}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="longitude" value="{{$bucket->longitude}}">
                        </div>
                        <div class="form-group col-md-6">
                           <br>
                           <label for="expense name">BucketName Name</label>
                           <input class="form-control" type="text" name="bucket_name_ip" value="{{$bucket->bucket_name_ip}}">
                        </div>
                        <div class="form-group col-md-6">
                           <a href="/search/Bucket" class="btn btn-warning">Go Back</a>
                           <button class="btn btn-primary sm" type="submit">update</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
