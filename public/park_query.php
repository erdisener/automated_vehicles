<?php
	 //park istasyonları ve yolculuk noktaları arasındaki verileri tablo olarak sistem yöneticisine gösterme
	$s_query = "SELECT * FROM `park_queries` ORDER BY `park_queries`.`query_id` DESC   ";

$result = mysqli_query($db_obj->link_object,$s_query); //sorgu infaz
		echo "<div class='container'>";
		echo "<table BORDER=1>";
		echo "<tr>";
			echo "<th> Sorgu ID </th>";
			echo "<th> Talep ID </th>";
			echo "<th> Park ID </th>";
			echo "<th> Park İstasyonları ve Başlangıç Noktası arasındaki mesafe (km) </th>";
			echo "<th> Park İstasyonları ve Başlangıç Noktası arasındaki yolculuk süresi (sn) </th>";
			echo "<th> Varış Noktası ve Park İstasyonları arasındaki mesafe (km) </th>";
			echo "<th> Varış Noktası ve Park İstasyonları arasındaki yolculuk süresi (sn) </th>";
		
			
		echo "</tr>";
		while (($row=mysqli_fetch_assoc ($result)))
		{   
			echo "<tr>";	
				echo "<td>".$row["query_id"]."</td>" ;  
				echo "<td>".$row["request_id"]."</td>";
				echo "<td>".$row["park_id"]."</td>";
				echo "<td>".$row["p_to_o_dist"]."</td>";
				echo "<td>".$row["p_to_o_sec"]."</td>";
				echo "<td>".$row["d_to_p_dist"]."</td>";
				echo "<td>".$row["d_to_p_sec"]."</td>";

				 
		    echo "</tr>";
		}//while 
		 
		
		echo "</table>";
		echo "</div>";
?>