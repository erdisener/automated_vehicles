<?php

						 
  class Class_DB{
		var $link_object  ;
	  
	function Db_Baglan($s_host,$s_user,$s_pass,$s_vt){//veritabanına bağlanma fonksiyonu
	
		$this->link_object = mysqli_connect($s_host, $s_user, $s_pass, $s_vt); 
	  
	}
 
  }
  

?>