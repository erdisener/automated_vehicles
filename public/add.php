<?php 
	// talep bilgilerinin veritabanına eklenmesi
	if($_POST["bt_save"] == "Kaydet" ){ 
		$s_query = "INSERT INTO `requests` 
		( `request_id`, 	`distance_km`, 
		  `duration_text`, 	`duration_sec`,
		  `earliest`, `latest`, `car_type`,
		  `fromlatlng`, 	`tolatlng`, 
		  `orijin`, `destination`) 
		 VALUES ( NULL,   ".SQL_Virgul_Filter($_POST["input_orj_to_dest_km"]).",  ".SQL_Tirnak($_POST["input_duration_text"]).", ".SQL_Virgul_Filter($_POST["input_duration_sec"]).", " . SQL_Tirnak($_POST["input_earliest_time"]).", ".SQL_Tirnak($_POST["input_latest_time"]).", ".SQL_Tirnak($_POST["input_car_type"]).", ".SQL_Tirnak($_POST["input_fromlatlng"]).",  ".SQL_Tirnak($_POST["input_tolatlng"]).", 
				   ".SQL_Tirnak($_POST["input_orijin"]).", ".SQL_Tirnak($_POST["input_destination"])."
				 );";
		$result = mysqli_query($db_obj->link_object,$s_query); //sorgu infaz


		// kaydedilen request_id verilerini veritabanından alma
		$s_query2 = "SELECT `request_id` FROM `requests` WHERE `request_id` = (SELECT MAX(`request_id`) FROM `requests`);";
	
		$result2 = mysqli_query($db_obj->link_object,$s_query2); //sorgu infaz
		$sonuc_id=mysqli_fetch_assoc ($result2);
	

		// park id alma
		$s_query3 = "SELECT `park_id` FROM `parks`;";
		//echo $s_query2;
		$result3 = mysqli_query($db_obj->link_object,$s_query3); //sorgu infaz
		$parks_id=mysqli_fetch_assoc ($result3);


		//park_query veritabanı tablosuna verileri kaydetme
		$s_query4 = "INSERT INTO `park_queries` (`request_id`, `park_id`, `p_to_o_dist`, `p_to_o_sec`, `d_to_p_dist`, `d_to_p_sec`) VALUES (".SQL_Virgul_Filter($sonuc_id["request_id"]).", ".SQL_Virgul_Filter($_POST["input_park_id_1"]).", ".SQL_Virgul_Filter($_POST["input_dist_p1_to_orj"]).", ".SQL_Virgul_Filter($_POST["input_duration_p1_to_orj_sec"]).", ".SQL_Virgul_Filter($_POST["input_dest_to_p1"]).", ".SQL_Virgul_Filter($_POST["input_duration_dest_to_p1_sec"])."), 
		
		(".SQL_Virgul_Filter($sonuc_id["request_id"]).", ".SQL_Virgul_Filter($_POST["input_park_id_2"]).", ".SQL_Virgul_Filter($_POST["input_dist_p2_to_orj"]).", ".SQL_Virgul_Filter($_POST["input_duration_p2_to_orj_sec"]).", ".SQL_Virgul_Filter($_POST["input_dest_to_p2"]).", ".SQL_Virgul_Filter($_POST["input_duration_dest_to_p2_sec"])."),
		
		(".SQL_Virgul_Filter($sonuc_id["request_id"]).", ".SQL_Virgul_Filter($_POST["input_park_id_3"]).", ".SQL_Virgul_Filter($_POST["input_dist_p3_to_orj"]).", ".SQL_Virgul_Filter($_POST["input_duration_p3_to_orj_sec"]).", ".SQL_Virgul_Filter($_POST["input_dest_to_p3"]).", ".SQL_Virgul_Filter($_POST["input_duration_dest_to_p3_sec"]).");";


		$result4 = mysqli_query($db_obj->link_object,$s_query4); 


		include( 'public/map.php');	
		
	}
	else{
		//Submit yok
		include( 'public/map.php');
	}
 

?>