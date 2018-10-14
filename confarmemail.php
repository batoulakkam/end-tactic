<?php
require_once('php/connectTosql.php');
function redirect(){
  header('Location:login.php?register=false');
  exit();
}
if (!isset($_GET['email']) || !isset($_GET['token'])) {
  redirect();
}
else{
 $con = mysqli_connect('localhost','root','','tactic');
 
 $email =$_GET['email'];
 $token =$_GET['token'];
   $sql = mysqli_query($con,"SELECT organizer_ID FROM account WHERE emailOrg ='$email' AND token='$token' AND isEmailconfirm=0")or die(mysqli_error($con)) ;
 
       if( $sql){
          mysqli_query($con,"UPDATE  account SET  isEmailconfirm= 1 WHERE  emailOrg='$email'");
          header('Location:login.php?register=false');
        }
	else {
		header('Location:login.php?register=false');
	}
  
}
?>