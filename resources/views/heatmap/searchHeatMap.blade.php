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
            <div class="card-header">Filter by Month & Year</div>
            <div class="card-body">
         <form  name = "selectDate" id ="selectDateId">
            {{ csrf_field()}}
            
            <div class="form-group col-md-6">
                <br>
                <label for="bucketSearch">Year</label> <input class="form-control" type="number" placeholder="E.g. 2018" name="year" REQUIRED>
            </div>
            <div class="form-group col-md-6">
                <br>
                <label for="month">Select Month</label>
                           <select name = "month">
                           <option value="1">January</option>
                           <option value="2">February</option>
                           <option value="3">March</option>
                           <option value="4">April</option>
                           <option value="5">May</option>
                           <option value="6">June</option>
                           <option value="7">July</option>
                           <option value="8">August</option>
                           <option value="9">September</option>
                           <option value="10">October</option>
                           <option value="11">November</option>
                           <option value="12">December</option>
                           </select>
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
</div>
        <script>
        function initMap(jsonResponse) {
        month = document.forms['selectDate']['month'].value;
         year = document.forms['selectDate']['year'].value;
         var url = "http://127.0.0.1:8000/map";
        fetch(url)
        .then(function(response) {
          response.json()
          .then(function(result) {
            console.log(result);
            var locations = result.map((val) => {
              // console.log(val.data_throughput);
                return {location: new google.maps.LatLng(val.latitude, val.longitude), key: val.data_throughput};
                // return {location: new google.maps.LatLng(val.latitude, val.longitude), weight: val.data_throughput};
              // return new google.maps.LatLng(val.latitude, val.longitude);
            })

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
          center: {lat: 0.0181605, lng: 37.074055},
          mapTypeId: 'roadmap'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: locations,
          map: map,
          maxIntensity: 25,
            radius: rad,
            opacity: opac
        });
        // console.log(heatmap.data);
        });
        });

      }

            document.getElementById('selectDateId').addEventListener('submit',initMap);
        </script>
   </body>
</html>
