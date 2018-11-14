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
    <form  action="/bucket/{{$bucket->id}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group col-md-6">
            <br>
            <label for="expense name">Expense Name</label>
            <input class="form-control" type="text" name="expense_name" value="{{$bucket->bucket_name}}">
        </div>
       <div class="form-group col-md-6">
            <a href="/buckets" class="btn btn-warning">Go Back</a>
            <button class="btn btn-primary sm" type="submit">update</button>
        </div>
    </form>   
</body>
</html>
