<?php 
								

function Karakter_Seti_Yukle ()
{
	$brouwser = $_SERVER['HTTP_USER_AGENT'];
        $s_return = "UTF-8";
	if(strstr($brouwser,"MSIE")) $s_return = "UTF-8 general";
	if(strstr($brouwser,"mozilla")) $s_return = "UTF-8";
    	echo $s_return;
}
       	
       	
        
 function SQL_Tirnak_Filter($a_kelime){	// String ve date verilerinin önüne ' ve sonuna ' konmalıdır. Arama fonksiyonlarında kullanılabilmesi için ön ek son ek konulmuştur.
	
	return trim(str_replace("'","`",$a_kelime));	//sağdan soldan kırp. 
}
		 
function SQL_Tirnak($a_kelime,$a_onek='',$a_sonek=''){	// String ve date verilerinin önüne ' ve sonuna ' konmalıdır. Arama fonksiyonlarında kullanılabilmesi için ön ek son ek konulmuştur
	return "'".$a_onek.SQL_Tirnak_Filter($a_kelime).$a_sonek."'";	//sağdan soldan kırp. 
}
function SQL_Virgul_Filter($a_kelime,$virgul=",",$nokta="."){	// Double sayılarda ayıraç nokta olmalı.
	
	return trim(str_replace($virgul,$nokta,$a_kelime));	//sağdan soldan kırp. 
}

 
 
?>