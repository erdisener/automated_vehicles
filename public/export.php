<?php

include 'core/site_init_admin.php';

	// modelde kullanılacak verileri, veritabanından çekip txt formatında lokal bilgisayara kaydetme
	 
	$s_query = "SELECT * FROM `requests` ORDER BY `requests`.`request_id` DESC   ";

	$p_query = "SELECT * FROM `parks` ORDER BY `parks`.`park_id` DESC   ";

	$q_query = "SELECT * FROM `park_queries` ORDER BY `park_queries`.`query_id` DESC   ";


	$query_result = mysqli_query($db_obj->link_object,$q_query);

	$park_result = mysqli_query($db_obj->link_object,$p_query);

	$result = mysqli_query($db_obj->link_object,$s_query); 

		
		
        $br = "\r\n";

		$request_file=fopen("request_list.txt", "w") or die ("Unable to open file!"); 
		$park_query_file=fopen("park_queries.txt", "w") or die ("Unable to open file!");
		$park_table_file=fopen("park_table.txt", "w") or die ("Unable to open file!");
		include( 'public/admin.php');

		// Request tablosunu export etme işlemi
		$add_request_row = "request_id;distance_km;duration_sec;duration_text;earliest;latest;car_type;fromlatlng;tolatlng;orijin;destination\n";
		fwrite($request_file, $add_request_row);

		while (($row=mysqli_fetch_assoc ($result)))
		{   
			$request_line2 = $row['request_id'] . ";" . $row['distance_km']. ";" . $row['duration_sec'] . ";" . $row['duration_text'] . ";" . $row['earliest'] . ";" . $row['latest'] . ";" . $row['car_type'] . ";" . $row['fromlatlng'] . ";" . $row['tolatlng'] . ";" . $row['orijin'] . ";" . $row['destination'] . "\n";

			 $request_data1 = $request_line2; 


			 fwrite($request_file, $request_data1);
		}//while 

		// Park_queries tablosunu export etme işlemi
		$add_queries_row = "query_id;request_id;park_id;p_to_o_dist;p_to_o_sec;d_to_p_dist;d_to_p_sec\n";
		fwrite($park_query_file, $add_queries_row);

		while (($row=mysqli_fetch_assoc ($query_result)))
		{   
			$park_query_line2 = $row['query_id'] . ";" . $row['request_id'] . ";" . $row['park_id'] . ";" . $row['p_to_o_dist'] . ";" . $row['p_to_o_sec'] . ";" . $row['d_to_p_dist'] . ";" . $row['d_to_p_sec'] . "\n";

			 $park_query_data1 = $park_query_line2;	

			 fwrite($park_query_file, $park_query_data1);
		}//while 


		// Parks tablosunu export etme işlemi

		$add_parks_row = "park_id;park_station;park_definition;num_of_s_car_type;num_of_m_car_type;num_of_xl_car_type\n";
		fwrite($park_table_file, $add_parks_row);

		while (($row=mysqli_fetch_assoc ($park_result)))
		{   
			$park_table_line2 = $row['park_id'] . ";" . $row['park_station'] . ";" . $row['park_definition'] . ";" . $row['num_of_s_car_type'] . ";" . $row['num_of_m_car_type'] . ";" . $row['num_of_xl_car_type'] . "\n";

			$park_table_data1 = $park_table_line2;
			fwrite($park_table_file, $park_table_data1);
		}//while 
		

		 fclose($request_file);
		 fclose($park_query_file);
		 fclose($park_table_file);
	
	

?>