<?php
//session_start();  
	 //ü for utf8 without bom notepad++
	
	include_once 'readonly/config_db.php' ; 
	 
	include_once '002_setisnotset.php' ;
	include_once '005_gl_func.php' ;
	include_once '006_db.php' ;


		$db_obj = new  Class_DB();
		$db_obj->Db_Baglan(DF_DB_HOST,DF_DB_USER,DF_DB_PASS,DF_DB_NAME);
		 

?>