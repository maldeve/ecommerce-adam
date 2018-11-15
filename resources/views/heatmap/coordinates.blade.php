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
  </head>

  <body onload="getCoordinates()">
    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
    </div>
    <div id="map"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>

    <script>
    const maxI = 25, rad = 21, opac = .6;
     var map, heatmap, collection;

      // This example requires the Visualization library. Include the libraries=visualization
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">
      var methods = ["GET", "POST"];
    var baseUrl = "http://127.0.0.1:8000/";
        function createObject(readyStateFunction,requestMethod,requestUrl, sendData = null){
            obj = new XMLHttpRequest;
            obj.onreadystatechange = function(){
            if((this.readyState ==4) && (this.status ==200)){
            readyStateFunction(this.responseText);
            }
            };
            obj.open(requestMethod, requestUrl, true);
            if (requestMethod == 'POST'){
            obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
            obj.setvarRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            obj.send(sendData);
            }
            else
            {
            obj.send();
            }
            }

    function getCoordinates(){
        createObject(initMap,methods[0],baseUrl + "mapCoordinates");
    }
 
    function getPointss(jsonResponse){
        // var responseObj = JSON.parse(jsonResponse);
        
        // var array = [for(tData is sonResponse){
        //     return (new google.map.LatLng(responseObj[tData].latitude,responseObj[tData].latitude));
        // }];
        // // array.push(jsonResponse);
        // console.log(array);
    }
     
      function initMap(jsonResponse) {
        fetch('/mapCoordinates')
        .then(function(response) {
          response.json()
          .then(function(result) {
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
 
      // Function to change maxIntensity of the heatmap
      function changeIntensity(bool) {
        const step = 25, min = 0, max = 25;
        let current = heatmap.get('maxIntensity');
        let newValue = toggleUpDown(bool, current, step, min, max);
        heatmap.set('maxIntensity', newValue);
        document.getElementById("intensityNum").innerText = newValue;
      };
      // Changes our toggle values and keeps them within our min/max values
      function toggleUpDown(bool, current, step, min, max){
        if (bool && current >= max) return current;
        if (!bool && current <= min) return current;
        if (bool) return current + step;
        return current - step;
      }
      // Used to round the opacity toggle to one decimal place
      function round(value, precision) {
        var multiplier = Math.pow(10, precision || 0);
        return Math.round(value * multiplier) / multiplier;
      }

      // Heatmap data: 500 Points
        function getPoints(jsonResponse){
            var responseObj = JSON.parse(jsonResponse);
            var array_of_functions = [
            function(){
                for (tData in responseObj)
            {
                    return ({location: new google.map.LatLng(responseObj[tData].latitude,responseObj[tData].longitude),weight:20});
        //         latLng.push({location:'new google.map.LatLng('+responseObj[tData].latitude+','+responseObj[tData].longitude+')',key:20});
        //             // new google.map.LatLng(responseObj[tData].latitude,responseObj[tData].latitude);
        //         ]:
            }
            }
        ];

        
            return (array_of_functions[0]('a string'));

        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpe5MxT-z7CHNWtJHCDm0cp9Mpiwuk3s&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>