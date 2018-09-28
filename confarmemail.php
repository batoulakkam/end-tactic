<?php
require_once('php/connectTosql.php');

function redirect(){
  header('Location:login.php?register=true');
  exit();
}
if (!isset($_GET['email']) || !isset($_GET['token'])) {
    echo "1";
  //redirect();
}
else{
 $con = mysqli_connect('localhost','root','','tactic');
 
 $email = $con->real_escape_string($_GET['email']);
 $token =$con->real_escape_string($_GET['token']);

  $sql = $con->query("SELECT organizer_ID FROM account WHERE emailOrg ='$email' AND token='$token' AND isEmailconfirm=0") or die(mysql_error()) ;
 
       if( $sql->num_rows  > 0 ){
          $con->query("UPDATE  account SET  isEmailconfirm=1, token='' WHERE  emailOrg='$email'");
          header('Location:login.php?register=true');
        }

  
}
?>