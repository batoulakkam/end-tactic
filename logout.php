<?php

require_once('php/connectTosql.php');
 unset( $_SESSION['organizerID']);
unset( $_SESSION['OrgName']);
unset( $_SESSION['orgEmail']);
unset( $_SESSION['password']);
unset( $_SESSION['emailconfirm']);


 if(isset($_GET['confirm'])){
	if($_GET['confirm'] == "false"){
		header("Location:LogIn.php?confirm=false");
		exit;
	}
 }
header("Location:LogIn.php");

?>