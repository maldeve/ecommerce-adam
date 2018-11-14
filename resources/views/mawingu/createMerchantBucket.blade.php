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
        <div class="row">
        <div class="col-sm-5">
       <div class="form-group col-md-6">
            <label for="firstName">First Name </label>
            <input class="form-control" type="text" name="first_name">
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Second Name</label>
            <input name="second_name" type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Client Type</label>
            <select name="client_type" class="form-control">
                <option>--Choose Client Type--</option>
                <option value="MKT">MKT<option>
            <select>
        </div>
        <div class="form-group col-md-6">
            <label for="nationalId">District</label>
            <input name="district" type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Address</label>
            <input name="address" type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Latitude</label>
            <input name="latitude" type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Longitude</label>
            <input name="longitude" type="text" class="form-control">
        </div>
        </div>
        <div class="col-sm-5">
        <div class="form-group col-md-6">
            <label for="nationalId">BS Name</label>
            <input name="bs_name" class="form-control" type="text">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Equipment</label>
            <select name="equipment" class="form-control">
                <option>--Choose Equipment--</option>
                <option value="CPE">CPE<option>
            <select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Equipment1</label>
            <select name="equipment1" class="form-control">
                <option>--Choose Equipment--</option>
                <option value="PB5">PB5<option>
                <option value="PBM5">PBM5<option>      
                <option value="PBE 5AC 500">PBE 5AC 500<option>
                <option value="PB3">PB3<option>
                <option value="NBM5">NBM5<option>
                <option value="NB19">NB19<option>
                <option value="LB5">LB5<option>
                <option value="LB3">LB3<option>
                <option value="LB23">LB23<option>
            <select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">IP Address</label>
            <input name="ip_address" type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="firstName">Bucket Name</label>
            <input class="form-control" type="text" name="bucket_name">
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Bucket Name IP</label>
            <input name="bucket_name_ip" class="form-control" type="text">
        </div>
        <div class="form-group col-md-6">
            <button class="btn btn-primary sm" type="submit">Submit</button>
        </div>
        </div>
        </div>
    </form>
</body>
</html>
