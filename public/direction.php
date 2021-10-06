<?php

include 'core/site_init_admin.php';

// veritabanından model sonuçlarını çekme
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db_obj->link_object,$_GET['id']);

    $s_query = "SELECT * FROM `result` WHERE id = $id  ";

    $query_result = mysqli_query($db_obj->link_object,$s_query);

    $demand = mysqli_fetch_assoc($query_result);

    mysqli_free_result($query_result);
    mysqli_close($db_obj->link_object);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
    #start {
    width:300px;
    margin-left: 30px;
   }
   #end {
    width:300px;
    margin-left: 60px;
   }
 
   #map {
        height: 50%;
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        display: block;
      }
 
    </style>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDgIMSK-JXpyntHX547M8vR8o5QNtGAYX8">
    </script>
</head>
<body>

<div class="container">
<a href="index.php?page=result_back" class="btn btn-warning" >Sonuçlara Dön</a>
<br></br>
<form id="direction_form">
                <div class="form-group"><label>Başlangıç Noktası: </label>
                    <input class="form-control" id="from_places" value="<?php echo htmlspecialchars($demand['orijin']); ?>"/>
                    <input id="origin_direction" name="origin_direction" required="" type="hidden" value="<?php echo htmlspecialchars($demand['orijin']); ?>"/>
                    
                </div>

                <div class="form-group"><label>Varış Noktası: </label>
                    <input class="form-control" id="to_places" value="<?php echo htmlspecialchars($demand['destination']); ?>"/>
                    <input id="destination_direction" name="destination_direction" required="" type="hidden" value="<?php echo htmlspecialchars($demand['destination']); ?>"/></div>

                 <input class="btn btn-primary" type="hidden" value="Rota"/>

</form>
<hr>

</div>

<div id="map"></div>

<script>
     $(function () {
        var origin, destination, map;

        google.maps.event.addDomListener(window, 'load', function (listener) {
            initMap();
            setDestination();
            $('#direction_form').submit();
        });

      function initMap() {
        var myLatLng = {
        lat: 40.197152,
        lng: 29.060754
        };
        map = new google.maps.Map(document.getElementById('map'), {zoom: 15, center: myLatLng,});
      }

        function setDestination() {
           var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
            var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

            google.maps.event.addListener(from_places, 'place_changed', function () {
                var from_place = from_places.getPlace();
                var from_address = from_place.formatted_address;
                $('#origin_direction').val(from_address);
            });

            google.maps.event.addListener(to_places, 'place_changed', function () {
                var to_place = to_places.getPlace();
                var to_address = to_place.formatted_address;
                $('#destination_direction').val(to_address);
            });
          }

        function displayRoute(origin, destination, directionsService, directionsDisplay) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING',
                avoidTolls: true
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                } else {
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('Gösterilecek rota bulunamadı: ' + status);
                }
            });
        }

        $('#direction_form').submit(function (e) {
            e.preventDefault();
            var origin = $('#origin_direction').val();
            var destination = $('#destination_direction').val();
            var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
            var directionsService = new google.maps.DirectionsService();
           displayRoute(origin, destination, directionsService, directionsDisplay);
        });
  });

  function getCurrentPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setCurrentPosition);
        } else {
            alert("Geolocation is not supported by this browser.")
        }
    }

function setCurrentPosition(pos) {
        var geocoder = new google.maps.Geocoder();
        var latlng = {lat: parseFloat(pos.coords.latitude), lng: parseFloat(pos.coords.longitude)};
        geocoder.geocode({ 'location' :latlng  }, function (responses) {
            console.log(responses);
            if (responses && responses.length > 0) {
                $("#origin_direction").val(responses[1].formatted_address);
                $("#from_places").val(responses[1].formatted_address);
            } else {
                alert("Cannot determine address at this location.")
            }
        });
    }


</script>
</body>
</html>