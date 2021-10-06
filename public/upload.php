<?php

// Performance list

echo "<div class='container'>";
  echo "<table BORDER=1>";
  echo "<p> <b> Performans Sonuçları </p> ";
  echo "<tr>";
    echo "<th> Ortalama Mesafe (km) </th>";
    echo "<th> Ortalama Süre (sn) </th>";
    echo "<th> Talep Karşılama Oranı (%) </th>";
    echo "<th> Park İstasyonu Kullanım Oranı </th>";
  echo "</tr>";
  
  $performance = new SplFileObject('performance.txt');
  while (!$performance->eof()) {
      $line_perf = $performance->fgets();
      list($ave_distance,$ave_time,$demand_ratio,$park_station_ratio)=explode(';',$line_perf);
      
      // Veri tabanına ekleme

      $s_query_perf = "INSERT INTO performance (`perf_id`, `ave_distance`, `ave_time`, `demand_ratio`, `park_station_ratio`) VALUES (NULL, '$ave_distance', '$ave_time', '$demand_ratio', '$park_station_ratio');";
   
      $result_perf = mysqli_query($db_obj->link_object,$s_query_perf); 

      // Listeden sırayla id alma

      $s_query_id_perf = " SELECT * FROM `performance` ";

      $query_id_result_perf = mysqli_query($db_obj->link_object,$s_query_id_perf);

    while ($row=mysqli_fetch_assoc ($query_id_result_perf)) {
    }
    
      echo "<tr>";	
        echo "<td>".$ave_distance."</td>" ;  
        echo "<td>".$ave_time."</td>";
        echo "<td>".$demand_ratio."</td>";
        echo "<td>".$park_station_ratio."</td>";

      echo "</tr>";
      

  }

  
  echo '</table>';
  echo '<hr>';
  echo '</div>';



// Result list

  echo "<div class='container'>";
  echo "<table BORDER=1>";
  echo "<p> <b> Atama Tablosu </p> ";
  echo "<tr>";
    echo "<th> Park ID </th>";
    echo "<th> Talep ID </th>";
    echo "<th> Araç Kodu </th>";
    echo "<th> Atama Durumu </th>";
    echo "<th> Başlangıç Nok. </th>";
    echo "<th> Varış Nok. </th>";
    echo "<th> Park Tanımı </th>";
    echo "<th> Araç Tipi </th>";
    echo "<th> Rota </th>";
  
  echo "</tr>";
  
  $file = new SplFileObject('outputs.txt');
  while (!$file->eof()) {
      $line = $file->fgets();
      list($park_id,$request_id,$com_id,$x_ijk,$orijin,$destination,$park_definition,$car_type)=explode(';',$line);
     
      // Veri tabanına ekleme

      $s_query = "INSERT INTO result (`id`, `park_id`, `request_id`, `com_id`, `x_ijk`, `orijin`, `destination`, `park_definition`, `car_type`) VALUES (NULL, '$park_id', '$request_id', '$com_id', '$x_ijk', '$orijin', '$destination', '$park_definition', '$car_type');";
   
      $result = mysqli_query($db_obj->link_object,$s_query); 

      // Listeden sırayla id alma

      $s_query_id = " SELECT * FROM `result` ";

      $query_id_result = mysqli_query($db_obj->link_object,$s_query_id);

    while ($row=mysqli_fetch_assoc ($query_id_result)) {
        $demand_id = $row['id'] ;
    }
    
      echo "<tr>";	
        echo "<td>".$park_id."</td>" ;  
        echo "<td>".$request_id."</td>";
        echo "<td>".$com_id."</td>";
        echo "<td>".$x_ijk."</td>";
        echo "<td>".$orijin."</td>";
        echo "<td>".$destination."</td>";
        echo "<td>".$park_definition."</td>";
        echo "<td>".$car_type."</td>";
        echo "<td><a href='index.php?page=direction&id=$demand_id'>Rota</a></td>";
       

      echo "</tr>";
      

  }

  
  echo '</table>';
  echo '<hr>';
  echo '</div>';


?>