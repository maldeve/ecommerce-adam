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
            <div class="card-header">Manage Buckets</div>
            <div class="card-body">
      <a href ="/addBucket" class="btn btn-sm btn-primary">create</a>
         <form action="/searchBucket" method="POST">
            {{ csrf_field()}}
            
            <div class="form-group col-md-6">
                <br>
                <label for="bucketSearch">Search Bucket</label>
                <input class="form-control" type="text" name="search" REQUIRED>
            </div>
            <div class="form-group col-md-6">
                <a href="/heatMap" class="btn btn-warning">Go Back</a>
                <button class="btn btn-primary sm" type="submit">Search</button>
            </div>
         </form>
         </div>
         </div>
      </div>
   </div>
</div>
         @if(isset($details))
         
         <h1>sample Bucket details</h1>
         <table class="table table-stripped">
            <thead>
               <tr>
               <th>#
               </th>
                  <th>Bucket Name
                  </th>
                  <th>district
                  </th>
                  <th>bs_name
                  </th>
                  <th>equipment
                  </th>
                  <th>client_type
                  </th>
                  <th>first_name
                  </th>
                  <th>second_name
                  </th>
                  <th>address
                  </th>
                  <th>equipment1
                  </th>
                  <th>ip_address
                  </th>
                  <th>latitude
                  </th>
                  <th>longitude
                  </th>
                  <th>bucket_name_ip
                  </th>

                  <th colspan="2" style="text-align:center"> Actions</th>

               </tr>
            <thead>
            <tbody>
            </tbody>
            @foreach($details as $bucket)
            <td>{{$bucket->id}}</td>
            <td>{{$bucket->bucket_name}}</td>
            <td>{{$bucket->district}}</td>
            <td>{{$bucket->bs_name}}</td>
            <td>{{$bucket->equipment}}</td>
            <td>{{$bucket->client_type}}</td>
            <td>{{$bucket->first_name}}</td>
            <td>{{$bucket->second_name}}</td>
            <td>{{$bucket->address}}</td>
            <td>{{$bucket->equipment1}}</td>
            <td>{{$bucket->ip_address}}</td>
            <td>{{$bucket->latitude}}</td>
            <td>{{$bucket->longitude}}</td>
            <td>{{$bucket->bucket_name_ip}}</td>
            <td><a href ="/bucket/edit/{{$bucket->id}}" class="btn btn-sm btn-primary">edit</a></td>
      <td> <form action="/bucket/delete/{{$bucket->id}}" method="POST" onsubmit()="are you sure you want to delete">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button class="btn btn-sm btn-danger"   onclick=" return confirm ('are you sure you want to delete')" type="submit">delete</button>
         </form></td>
            @endforeach
         </table>
         @elseif(isset($message))
         <p>{{$message}}</p>
         @endif
      </div>

     
   </body>
</html>
