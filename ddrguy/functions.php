<?php
ini_set("display_errors","on");
//error_reporting(E_ALL && ~E_NOTICE);
?>
<?php

function fixtext($text){
	require("connect.php");
	$finishedtext = strip_tags($text);
	$finishedtext = stripslashes($finishedtext);
    
  
   $finishedtext = mysqli_real_escape_string($con, $finishedtext);
   
	//$finishedtext = str_replace('"', "&#34;", $finishedtext);
	//$finishedtext = str_replace("'", "&#39;", $finishedtext);
	$finishedtext = str_ireplace("fuck", "f*****ck", $finishedtext);
	$finishedtext = str_ireplace("asshole", "a**s**s*", $finishedtext);
	$finishedtext = str_ireplace("slut", "s***l**t", $finishedtext);
	$finishedtext = str_ireplace("bitch", "b**t***h", $finishedtext);
	$finishedtext = str_ireplace("whore", "w***h**o", $finishedtext);
	$finishedtext = str_ireplace("shit", "s***h**t", $finishedtext);
	
	
	return $finishedtext;

}

?>