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
$mail->Subject  =  'استعادة كلمة المرور ';
      $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890<>()!#%&/$*';
      $token= str_shuffle($token);
      $token= substr($token,0,10);

if(isset($_POST['Email']))
{
  $orgEmail= $_POST['Email'];
  $select=mysqli_query($con,"SELECT * FROM account WHERE email-org = '$orgEmail'");
	if($select)
		echo "true";
  // if(!empty($row['emailOrg']))
   //   $email=$row['emailOrg'];
    $link="http://localhost/tactic/newPassword.php?key=".$token;
	$mail->Body    = 'أهلا بك تم استلام طلب تغير كلمة المرور في حال أردت تغيرها اضغط على الرابط لاستعادة كلمة لمرور '.	
		'http://localhost/tactic/newPassword.php?key='.$token;
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