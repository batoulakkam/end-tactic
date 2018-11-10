<?php
require_once('php/connectTosql.php');
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");
$eventName = "";
$location  = "";
$startDate = "";
$endDate   = "";
$attendeeName ="";
$email_Att ="";
$masg ="";	
if (isset($_GET['attendeeId'])) {
    $attendeeID = $_GET['attendeeId'];
    $query      = mysqli_query($con, "SELECT * FROM attendee WHERE Id= '$attendeeID'");
    $row        = mysqli_fetch_array($query);
    $eventID    = $row['eventId'];
    $token      = $row['form'];
    $attendeeName      = $row['name'];
    $email_Att      = $row['email'];
    $query2     = mysqli_query($con, "SELECT * FROM event WHERE event_ID = '$eventID'");
    while ($row = mysqli_fetch_array($query2)) {
        $eventName = $row[1];
        $location  = $row[5];
        $startDate = $row[3];
        $endDate   = $row[4];
    } //$row = mysqli_fetch_array($query2)

$locationBadge = "UploadFile/".$eventID."/badge/".$attendeeID.".jpg";
$subject =   " شكرا لتسجيلك في " .$eventName;
$body='<h3> البطاقة التعريفية الخاصة بك </h3>  <br> <img id="badgePrint" src="'. $locationBadge.'" />';
$mail          = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet =  "utf-8";
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = 'tactic.gp@gmail.com';   
$mail->Password = '1234567890Qw';   
$mail->setfrom('tactic.gp@gmail.com','tactic');
$mail->Subject  = $subject;
	$mensaje = file_get_contents('emailTemplate.html');
	$mensaje =  str_replace("{{USERNAME}}",$attendeeName,$mensaje);
	$mensaje =  str_replace("{{eventName}}",$eventName,$mensaje);	 
	$mensaje =  str_replace("{{eventDate}}",$startDate,$mensaje);	 
	$mensaje =  str_replace("{{subject}}",$body,$mensaje);	 

$headers = 'From: tactic.gp@gmail.com' . "\r\n" .
    'errors-to: tactic.gp@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
/////////////////////////////////////////////////////////////////
$mail->Body = $mensaje;
$mail->AddAddress($email_Att);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

		if(!$mail->send()) 
		{
		
			$masg =" <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong>  غير متوقع ! فضلا حاول مرة اخرى.
       </div> ";
		
		}
		   else {
		 
		$masg =" <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> تم </strong>  الارسال بنجاح
       </div> ";
				}
} //isset($_GET['attendeeID'])
?>
<!DOCTYPE html>
<html lang="ar">
   <head>
      <title>شكرا لتسجيلك</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css' />
      <link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
      <link rel="stylesheet" href="css/layouts/custom.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/main-rtl.css">
      <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />
   </head>
   <body>
      <div class="mainContent">
         <div class="container">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h4 class="panelTitle"> شكرا لتسجيلك في <?php echo $eventName; ?> </h4>
               </div>
               <div class="panel-body">
                  <div class="col-md-12">
                     <pre>
<h5>اسم الحدث : <mark><?php echo $eventName; ?></mark></h5>
<h5>موقع الحدث : <mark> <?php echo $location; ?></mark> </h5>
<h5>تاريخ بداية الحدث : <mark> <?php echo $startDate; ?></mark></h5>
<h5>تاريخ نهاية الحدث : <mark><?php echo $startDate; ?></mark></h5>
</pre>
                     <pre>
<h5>الباركود الخاص بك :</h5>

<a  ><img id="badgePrint" src="<?php echo $locationBadge;?>" /></a>
</pre>
                     <a href="#" class="btn btn-nor-primary btn-lg enable-overlay" id="print" onclick="printJS(<img src='image\logo.png' )">
                     <span class="glyphicon glyphicon-print"></span> طباعة 
                     </a>				
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end of  register inputs -->
      <script src="js/jquery.min.js"></script>
      <script src="js/jquery.validate.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/appjs/common.js"></script>
      <script src="js/print.min.js"></script>
   </body>
</html>
<?php

?>
 