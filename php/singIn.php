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
	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
	$query = mysqli_query($con,"SELECT * FROM account WHERE `emailOrg` = '$orgEmail' AND  `passwordOrg` = '$hashedPassword'");
	$row = mysqli_fetch_array($query);
	if($query)
	{
        $_SESSION['organizerID']= $row['organizerID'];
		$_SESSION['orgEmail']= $row['emailOrg'];
        $_SESSION['password']= $row['passwordOrg'];
        header('Location:../addEvent.php');
        exit();
        } // end if 
    else{
        header('Location:../LogIn.php?error=false');
        exit();}
}


?>