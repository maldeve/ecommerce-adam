<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>coordinates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body onLoad="getCoordinates()">
    <script>
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
        createObject(placeCoordinates,methods[0],baseUrl + "mapCoordinates");
    }

    function placeCoordinates(jsonResponse){
        var responseObj = JSON.parse(jsonResponse);
        var coordinates = [];
         for (tData in responseObj)
            {
                coordinates.push({location:'new google.map.LatLng('+responseObj[tData].latitude+','+responseObj[tData].longitude+')',key:20});
                    // new google.map.LatLng(responseObj[tData].latitude,responseObj[tData].latitude);
            
            }
            console.log(coordinates);
            // for (coordinate in coordinates){
            //     console.log(Loation:coordinate)
            // }

               
    }
    </script>
</body>
</html>