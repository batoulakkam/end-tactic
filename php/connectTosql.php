<?php  
session_start();
$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASSWORD = '';
	$DB_DATABASE = 'tactic';
//connect to mysql
	 $con = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	 global  $con;
	if(!$con){
	die('filed to connect to server'.mysql_error());
				}

//SELECT DB
$db = mysql_select_db($DB_DATABASE, $con);
if(!$db){
	die("Unable to select database");
}
 if(isset($_GET['valid'])){
      echo '<script type="text/javascript">alert("Invalid Username/Password")</script>';
    }

?>