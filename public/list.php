<?php

  // veritabanına kaydedilen talep bilgilerini tablo şeklinde sistem yöneticisine gösterme
	 
	$s_query = "SELECT * FROM `requests` ORDER BY `requests`.`request_id` DESC   ";

$result = mysqli_query($db_obj->link_object,$s_query); //sorgu infaz
		echo "<div class='container'>";
		echo "<table BORDER=1>";
		echo "<tr>";
			echo "<th>Talep ID </th>";
			echo "<th>Başlangıç Noktası - Varış Noktası arası mesafe (km) </th>";
			echo "<th>Başlangıç Noktası - Varış Noktası arası yolculuk süresi </th>";
			echo "<th>Başlangıç Noktası - Varış Noktası arası yolculuk süresi (sn) </th>";
			echo "<th>En erken araç talep zamanı </th>";
			echo "<th>En geç araç talep zamanı </th>";
			echo "<th>Araç tipi </th>";
			echo "<th>Başlangıç Noktası enlem-boylam derecesi</th>";
			echo "<th>Varış Noktası enlem-boylam derecesi</th>";
			echo "<th>Başlangıç Noktası</th>";
			echo "<th>Varış Noktası</th>";
		echo "</tr>";
		while (($row=mysqli_fetch_assoc ($result)))
		{   
			echo "<tr>";	
				echo "<td>".$row["request_id"]."</td>"  ;  
				echo "<td>".$row["distance_km"]."</td>"  ;  
				echo "<td>".$row["duration_text"]."</td>"  ;  
				echo "<td>".$row["duration_sec"]."</td>"  ; 
				echo "<td>".$row["earliest"]."</td>"  ; 
				echo "<td>".$row["latest"]."</td>"  ; 
				echo "<td>".$row["car_type"]."</td>"  ;  
				echo "<td>".$row["fromlatlng"]."</td>"  ;  
				echo "<td>".$row["tolatlng"]."</td>"  ; 		
				echo "<td>".$row["orijin"]."</td>"  ;  
				echo "<td>".$row["destination"]."</td>"  ;  
		    echo "</tr>";
		}//while 
		 
		
		echo "</table>";
		echo "</div>";
?>