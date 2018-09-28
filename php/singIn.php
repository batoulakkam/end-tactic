<?php
require_once('connectTosql.php');
if (isset($_POST['Email']) and isset($_POST['Password']))
{
    
   SignIn();
   
}
 

// method 
function SignIn()
{
    $orgEmail = $_POST['Email'];
    $password = $_POST['Password'];
	$query = mysql_query("SELECT * FROM `account` WHERE `emailOrg` = '$orgEmail' AND  `passwordOrg` = '$password'")or die(mysql_error());
	$row = mysql_fetch_array($query);
	if(!empty($row['emailOrg']) AND !empty($row['passwordOrg']))
	{
        $_SESSION['organizerID']= $row['organizerID'];
		$_SESSION['orgEmail']= $row['emailOrg'];
        $_SESSION['password']= $row['passwordOrg'];
        header('Location:../addEvent.html');
        exit();
        } // end if 
    else{
        header('Location:../LogIn.php?error=false');
        exit();}
}


?>