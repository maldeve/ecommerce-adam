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
    <form action="/createBucket" method="POST">
        @csrf
       <div class="form-group col-md-6">
            <label for="firstName">Bucket Name</label>
            <input class="form-control" type="text" name="member_first_name">
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Data throughput</label>
            <input name="member_last_name" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="nationalId">Latitude</label>
            <input name="member_national_id" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Longitude</label>
            <input name="member_email" type="email" class="form-control">
        </div>
        <div class="form-group col-md-6">
        <a href="/heatMap" class="btn btn-warning">Go Back</a>
         <button class="btn btn-primary sm" type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
