<?php
	require_once('connectTosql.php');
    require("../PHPMailer/src/PHPMailer.php");
    require("../PHPMailer/src/SMTP.php");
    require("../PHPMailer/src/Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet =  "utf-8";
$mail->Host = "smtp.gmail.com";
$mail->IsSMTP();
// enable SMTP authentication
 $mail->SMTPAuth = true; 
$mail->Username = "tactic.event@gmail.com";
 // GMAIL password
    $mail->Password = "event1234567890$";
$mail->SMTPSecure = "ssl"; // ot TLS
 // set the SMTP port for the GMAIL server
    $mail->Port = "465"; // or 587 LTS
$mail->Subject  =  'Reset Password';


if(isset($_POST['emailOrg']))
{
  $orgEmail= $_POST['emailOrg'];
  $select=mysql_query("SELECT * FROM `account` WHERE `email-org` = '$orgEmail'");
	if($select)
		echo "true";
  // if(!empty($row['emailOrg']))
   //   $email=$row['emailOrg'];
    $link="<a href='http://localhost/tactic-master/newPassword.php?key=$orgEmail</a>";
	$mail->Body    = 'Click On This Link to Reset Password '.$link.'';
	$mail->setfrom('tactic.event@gmail.com','tactic');
    $mail->AddAddress($orgEmail);
     if($mail->Send())
    {
      header('Location:../resetPassword.php?sent=true');
    }
    else
    {
      header('Location:../resetPassword.php?sent=false');
    }
  

}
?>