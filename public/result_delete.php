<?php

include 'core/site_init_admin.php';

// model sonuçlarını veritabanından silme

$s_query = "DELETE FROM `result`";
$result = mysqli_query($db_obj->link_object,$s_query);

?>