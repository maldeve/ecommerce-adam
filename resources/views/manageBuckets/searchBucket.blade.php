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
         @if(isset($details))
         
         <h1>sample Bucket details</h1>
         <table class="table table-stripped">
            <thead>
               <tr>
               <th>#
               </th>
                  <th>Bucket Name
                  </th>
                  <th>Data Throughput
                  </th>
                  <th colspan="2" style="text-align:center"> Actions</th>

               </tr>
            <thead>
            <tbody>
            </tbody>
            @foreach($details as $bucket)
            <td>{{$bucket->id}}</td>
            <td>{{$bucket->bucket_name}}</td>
            <td>{{$bucket->data_throughput}}</td>
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
