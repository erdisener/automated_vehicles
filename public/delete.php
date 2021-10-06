<?php

include 'core/site_init_admin.php';

// veritabanındaki talep verilerini silme
$s_query4 = "DELETE FROM `park_queries`";
$result4 = mysqli_query($db_obj->link_object,$s_query4);
    
    $s_query = "DELETE FROM `requests`";
    $result = mysqli_query($db_obj->link_object,$s_query);


?>