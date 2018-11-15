<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 25%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css">
  </head>
 <body>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
   

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <button class="btn-success btn-sm"><a class="nav-link" href="/upload">upload <span class="sr-only">(current)</span></a></button>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="addBucket">add a bucket</a>
        </li>
       
        </ul>
        
    </div>
    </nav>

    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
      <button onclick="upload()">Upload Data</button>
      <button onclick="add()">Add bucket</button>
      <button class="btn btn-info pull-right btn-xs" id="read-data">Read Data</button>
    </div>
    <div id="map"></div>
    <script type="text/javascript">

      // This example requires the Visualization library. Include the libraries=visualization
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

      // test if data is coming
      var methods = ["GET", "POST"];
      var baseUrl = "http://127.0.0.1:8000/readData";
      var coordinates;

      // function createObject(readyStateFunction,requestMethod,requestUrl, sendData = null){
      //     var obj = new XMLHttpRequest;
      //     obj.onreadystatechange = function(){
      //     if((this.readyState ==4) && (this.status ==200)){
      //     readyStateFunction(this.responseText);
      //     }
      //     };
      //     obj.open(requestMethod, requestUrl, true);
      //     if (requestMethod == 'POST'){
      //     obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
      //     obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      //     obj.send(sendData);
      //     }
      //     else
      //     {
      //     obj.send();
      //     }
      // }
 
      $('#read-data').on('click', function() {
       // createObject(getCoordinates, methods[0], baseUrl + "readData")
        $.get(baseUrl, function(data) {
          // console.log(typeof(data));
          var coordinates = [];
            $.each(data, function(i, value) {
            coordinates.push(value.latitude, value.longitude);
          });
          var dataBus = JSON.parse(coordinates);
          console.log(dataBus);
          // data.json().then(function(data) {
          // coordinates = result.locations.map((val) => {
          //   console.log(new google.maps.LatLng(val.latitudeE7 * (10 ** -7),
          //   val.longitudeE7 * (10 ** -7)));
          // }
          // console.log(getPoints);
        });

      });

      // function getCoordinates(jsonResponse){
      //   console.log(jsonResponse);
      // }
    
      var map, heatmap;

      function add(){
          document.getElementById();
      }

      // $.get(baseUrl, function(data) {
      //     // console.log(data);
      //     coordinates = [new google.maps.LatLng(data)];
        
      // });

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 0.0181605, lng: 37.074055},
          mapTypeId: 'satellite'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: coordinates,
          map: map
        });
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // // Heatmap data: 500 Points
      // var getPoints = [
      //     new google.maps.LatLng(0.04314, 37.65125, 26),
      //     new google.maps.LatLng(0.04739, 37.65567, 35),
      //     new google.maps.LatLng(0.04801, 37.65549, 5),
      //   ]
        // $.get(baseUrl, function(data) {
        //   // console.log(data);
        //   let coordinates = [];
        //   for (let i = 0; i < data.length; i++) {
        //     coordinates.push('new google.map.LatLng('+data[i].latitude+','+data[i].longitude+')'];
            
        //   }
        //   // $.each(data, function(i, value) {
        //   //   console.log(value.latitude, value.longitude);
        //   //   // console.log(coordinates);
        //   // });
        // });
      //}
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpe5MxT-z7CHNWtJHCDm0cp9Mpiwuk3s&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>