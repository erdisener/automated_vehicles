<?php

		include 'core/site_init_admin.php';
 
	?><!doctype html>
<html lang="tr">

<head>
    <meta charset="<?php echo Karakter_Seti_Yukle() ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="tr">
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Karakter_Seti_Yukle() ?>"/>
    <title>Otonom Araç Yönetim Sistemi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Automated Vehicles">

    <!-- IE ayarları -->
    <meta name="msapplication-tap-highlight" content="no"> 

 <!-- Stil ayarları -->
    <link
      href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
      id="bootstrap-css"
      rel="stylesheet"
    />
	<link rel="stylesheet" href="style.css" />
	
    <!--Ajax kütüphanesi yükleme-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--Google maps places api yükleme-->
    <script
      defer
      src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&language=en&key=AIzaSyDgIMSK-JXpyntHX547M8vR8o5QNtGAYX8"
      type="text/javascript"
    ></script>
     <!--Google maps geocode api enlem boylam yükleme-->
     <script>
      "https://maps.googleapis.com/maps/api/geocode/json"
    </script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	
	</head>
<body> 
<div class="container">
  <div class="links">
	<a href="index.php?page=request_add" class="btn btn-primary" >Talep Oluştur </a>
  <a href="index.php?page=admin_page" class="btn btn-info" >Sistem Yönetimi </a>
  </div> <hr>
	

</div>
  <!-- Sayfalar arasında ve aynı sayfada link yönlendirmeleri -->
			<?php 
					switch($_GET[CP_PARAM_PAGE]) {
						case "request_add": 
							if($_POST["bt_save"] == "Kaydet" ){ 
								include( 'public/add.php');
							}
							else{
								include( 'public/map.php');
							}	
						
              break;
              case "admin_page":
                include( 'public/admin.php');
                break;
            case "request_list":
              include( 'public/admin.php');
							include( 'public/list.php');
              break;
              case "park_query_list":
                include( 'public/admin.php');
                include( 'public/park_query.php');
                break;
                case "request_delete":
                  include( 'public/admin.php');
                    include('public/delete.php');
                    echo "<div class='container'>";
                   echo 'Tüm talepler silindi!';
                   echo "</div>";
              break;
              case "request_export":
                include( 'public/export.php');
                echo "<div class='container'>";
                echo 'Talep listesi klasöre çıkarıldı!';
                echo '<br>';
                echo 'Park istasyonu sorguları klasöre çıkarıldı!';
                echo '<br>';
                echo 'Park tablosu klasöre çıkarıldı!';
                echo "</div>";
                 break;
                 case "request_result":
                  include( 'public/admin.php');
                  include( 'public/result.php');
                   break;
                   case "result_show":
                    include( 'public/admin.php');
                    include( 'public/result.php');
                    include('public/result_delete.php');
                    include( 'public/upload.php');
                     break;
                     case "result_delete":
                      include( 'public/admin.php');
                      include( 'public/result.php');
                        include('public/result_delete.php');
                        echo "<div class='container'>";
                       echo 'Tüm sonuçlar silindi!';
                       echo "</div>";
                  break;
                  case "direction":
                      include('public/direction.php');
                break;
                case "result_back":
                  include( 'public/admin.php');
                  include( 'public/result.php');
                  include('public/result_delete.php');
                  include( 'public/upload.php');
              break;
                break;
						default:
							include( 'public/map.php');
              break;

					}
					
			?>
</body>



<script>
      //Başlangıç noktası için enlem boylam ayarları alma fonksiyonu
      function geocodeF() {
        var location = document.getElementById("orijin_point").value;
        axios
          .get("https://maps.googleapis.com/maps/api/geocode/json", {
            params: {
              address:  location,
              key: "AIzaSyDgIMSK-JXpyntHX547M8vR8o5QNtGAYX8"
            }
          })
          .then(function(response) {
            // Log full response
            console.log(response);

            var latF = response.data.results[0].geometry.location.lat.toFixed(
              4
            );
            var lngF = response.data.results[0].geometry.location.lng.toFixed(
              4
            );
            $("#fromlatlng").text(latF + " " + lngF);
            $("#input_fromlatlng").val(latF + " " + lngF);

            console.log(latF, lngF);
          })
          .catch(function(error) {
            console.log(error);
          });
      }
      //Hedef noktası için enlem boylam ayarları alma fonksiyonu
      function geocodeT() {
        var location = document.getElementById("destination_point").value;
        axios
          .get("https://maps.googleapis.com/maps/api/geocode/json", {
            params: {
              address: location,
              key: "AIzaSyDgIMSK-JXpyntHX547M8vR8o5QNtGAYX8"
            }
          })
          .then(function(response) {
            
            console.log(response);

            var latT = response.data.results[0].geometry.location.lat.toFixed(
              4
            );
            var lngT = response.data.results[0].geometry.location.lng.toFixed(
              4
            );
            $("#tolatlng").text(latT + " " + lngT);
           
			      $("#input_tolatlng").val(latT + " " + lngT);

            console.log(latT, lngT);
          })
          .catch(function(error) {
            console.log(error);
          });
      }
 

      $(function() {
        
        // giriş (input) noktaları ekleme
        google.maps.event.addDomListener(window, "load", function() {
          var orijin_point = new google.maps.places.Autocomplete(
            document.getElementById("orijin_point")
          );
          var destination_point = new google.maps.places.Autocomplete(
            document.getElementById("destination_point")
          );

          google.maps.event.addListener(
            orijin_point,
            "place_changed",
            function() {
              var from_place = orijin_point.getPlace();
              var from_address = from_place.formatted_address;
              $("#origin").val(from_address);
            }
          );

          google.maps.event.addListener(destination_point, "place_changed", function() {
            var to_place = destination_point.getPlace();
            var to_address = to_place.formatted_address;
            $("#destination").val(to_address);
          });
        });
        // mesafe hesaplama
        function calculateDistance() {
          var origin = $("#origin").val();
          var destination = $("#destination").val();
          var park1 = "6W7R+3H Nilüfer, Bursa";
          var park2 = "53W4+R3 Osmangazi/Bursa, Türkiye";
          var park3 = "55W9+Q2 Yıldırım/Bursa, Türkiye";
          var service = new google.maps.DistanceMatrixService();
          service.getDistanceMatrix(
            {
              origins: [origin, park1, park2, park3, destination],
              destinations: [destination, park1, park2, park3, origin],
              travelMode: google.maps.TravelMode.DRIVING,
              unitSystem: google.maps.UnitSystem.metric,
              avoidHighways: false,
              avoidTolls: false
            },
            callback
          );
        }
        // mesafe sonuçlarını alma
        function callback(response, status) {
          if (status != google.maps.DistanceMatrixStatus.OK) {
            $("#result").html(err);
          } else {
            var origin = response.originAddresses[0];
            var p1 = response.originAddresses[1];
            var p2 = response.originAddresses[2];
            var p3 = response.originAddresses[3];
            var dest = response.originAddresses[4];
            var destination = response.destinationAddresses[0];
            var park1 = response.destinationAddresses[1];
            var park2 = response.destinationAddresses[2];
            var park3 = response.destinationAddresses[3];
            var orj = response.destinationAddresses[4];
            if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
              $("#result").html(
                "Better get on a plane. There are no roads between " +
                  origin +
                  " and " +
                  destination
              );
            } else {
              // orijin destination arası mesafe hesaplama
              var distance = response.rows[0].elements[0].distance;
              // park noktaları ile orijin arası mesafe hesaplama
              var distance1 = response.rows[1].elements[4].distance;
              var distance2 = response.rows[2].elements[4].distance;
              var distance3 = response.rows[3].elements[4].distance;
              // destination ile park noktaları arası mesafe hesaplama
              var distance4 = response.rows[4].elements[1].distance;
              var distance5 = response.rows[4].elements[2].distance;
              var distance6 = response.rows[4].elements[3].distance;
              // orijin noktası ile destination arası yolculuk süresi hesaplama
              var duration = response.rows[0].elements[0].duration;
              // park noktaları ile orijin arası yolculuk süresi hesaplama
              var duration1 = response.rows[1].elements[4].duration;
              var duration2 = response.rows[2].elements[4].duration;
              var duration3 = response.rows[3].elements[4].duration;
              // destination ile park noktaları arası yolculuk süresi hesaplama
              var duration4 = response.rows[4].elements[1].duration;
              var duration5 = response.rows[4].elements[2].duration;
              var duration6 = response.rows[4].elements[3].duration;
              // hesaplanan mesafelerin metreden km değerine çevrilmesi
              var distance_km = distance.value / 1000; 
              var dist_p1_to_orj = distance1.value / 1000; 
              var dist_p2_to_orj = distance2.value / 1000; 
              var dist_p3_to_orj = distance3.value / 1000; 
              var dist_dest_to_p1 = distance4.value / 1000;
              var dist_dest_to_p2 = distance5.value / 1000;
              var dist_dest_to_p3 = distance6.value / 1000;


              // yolculuk sürelerinin saniye cinsinden değer alması
              var duration_sec = duration.value;
              var duration_p1_to_orj_sec = duration1.value;
              var duration_p2_to_orj_sec = duration2.value;
              var duration_p3_to_orj_sec = duration3.value;
              var duration_dest_to_p1_sec = duration4.value;
              var duration_dest_to_p2_sec = duration5.value;
              var duration_dest_to_p3_sec = duration6.value;

              var duration_text = duration.text;

              var car_type = $("#carType").val();
              var earliest_time = $("#earliest").val();
              var latest_time = $("#latest").val();
           
              
              $("#distance_km").text(distance_km.toFixed(2));  
              $("#duration_text").text(duration_text); 
              $("#duration_sec").text(duration_sec); 
              $("#from").text(origin);
              $("#to").text(destination);

            //modele verilecek adres metin karakterlerinin ingilizce harflerle değiştirme
              String.prototype.turkishtoEnglish = function () {
                return this.replace(/Ğ/gim, "g")
                    .replace(/Ü/gim, "u")
                    .replace(/Ş/gim, "s")
                    .replace(/I/gim, "i")
                    .replace(/İ/gim, "i")
                    .replace(/Ö/gim, "o")
                    .replace(/Ç/gim, "c")

                    .replace(/ğ/gim, "g")
                    .replace(/ü/gim, "u")
                    .replace(/ş/gim, "s")
                    .replace(/ı/gim, "i")
                    .replace(/ö/gim, "o")
                    .replace(/ç/gim, "c");
            };
       

             // hesaplanan mesafe ve süre verilerini input box lara yazdırma 			  
			  $("#input_orj_to_dest_km").val(distance_km.toFixed(2));
			  $("#input_duration_text").val(duration_text);
			  $("#input_duration_sec").val(duration_sec);
			  $("#input_orijin").val(origin.turkishtoEnglish()); 
			  $("#input_destination").val(destination.turkishtoEnglish());

        $("#input_dist_p1_to_orj").val(dist_p1_to_orj.toFixed(2));
        $("#input_dist_p2_to_orj").val(dist_p2_to_orj.toFixed(2));
        $("#input_dist_p3_to_orj").val(dist_p3_to_orj.toFixed(2));

        $("#input_duration_p1_to_orj_sec").val(duration_p1_to_orj_sec);
        $("#input_duration_p2_to_orj_sec").val(duration_p2_to_orj_sec);
        $("#input_duration_p3_to_orj_sec").val(duration_p3_to_orj_sec);


        $("#input_dest_to_p1").val(dist_dest_to_p1.toFixed(2));
        $("#input_dest_to_p2").val(dist_dest_to_p2.toFixed(2)) ;
        $("#input_dest_to_p3").val(dist_dest_to_p3.toFixed(2));

        $("#input_duration_dest_to_p1_sec").val(duration_dest_to_p1_sec);
        $("#input_duration_dest_to_p2_sec").val(duration_dest_to_p2_sec);
        $("#input_duration_dest_to_p3_sec").val(duration_dest_to_p3_sec);

        $("#input_park_id_1").val("1");
        $("#input_park_id_2").val("2");
        $("#input_park_id_3").val("3");


        $("#input_earliest_time").val(earliest_time);
        $("#input_latest_time").val(latest_time);
        $("#input_car_type").val(car_type);
			  
			  
			  
            }
          }
        }
        // sonuçları forma yazdırma
        $("#distance_form").submit(function(e) {
          e.preventDefault();
          calculateDistance();
          geocodeF();
          geocodeT();
        });
      });
    </script>
	
	
	
</html>
 