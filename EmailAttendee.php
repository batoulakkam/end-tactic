<?php
require_once('php/connectTosql.php');
 require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");
	$email_Att="";
	$masg ="";	
	if(isset($_GET['AttendeeID'])){
	$attendeeID = $_GET['AttendeeID'];
	$sql = mysqli_query($con, "SELECT * FROM attendee WHERE Id ='$attendeeID' ") or die(mysqli_error($con)) ;
	$row = mysqli_fetch_array($sql);
	$email_Att = $row [1];
	$name = $row [2];
		
			   }


////////////////////////////////////////////////////////////////////////////
 if (isset( $_POST['submit'])) {
    
    
     $subject =$_POST['subject'];
     $body =$_POST['message'];
	 if(isset($_POST['logo']))
    $logo = $_POST['logo'];
$mail = new PHPMailer\PHPMailer\PHPMailer();
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
	$mensaje =  str_replace("{{USERNAME}}",$name,$mensaje);
	$mensaje =  str_replace("{{eventName}}",$name,$mensaje);	 
	$mensaje =  str_replace("{{eventDate}}",$name,$mensaje);	 
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

 }
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<title>ارسال بريد </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- lobrary of icon  fa fa- --->


  <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' type='text/css' />
  <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' type='text/css' />
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
  <link rel="stylesheet" href="css/layouts/custom.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/icon.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main-rtl.css">

  <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="jQuery-TE/jquery-te-1.3.2.css" charset="utf-8" />

  <!-------------------------------------------------------------------------->

</head>

<body>


  <!-- Body of register Page -->
  <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">ارسال بريد الكتروني  </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDiv" method="post"autocomplete="on">
			  <?php  if ($masg !="") echo $masg."<br>"; ?>
         	<div class="col-md-12">
          <div class="form-group form-group-lg">
			  
		<label for="eventName" class="control-label">المستقبل : </label> 
		<input type="text"  class="form-control"  name ="emailTo " value="<?PHP echo $email_Att; ?>" disabled/>
		 
        </div>
            </div>    
    <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label class="control-label"> الموضوع : </label>
  				<input type="text" class="form-control" id="email" name="subject"  >
  
			  </div>
			
		   <div class="col-md-12">
                        <div class="form-group form-group-lg">
							<div id="froala-editor1">
                           <label  class="control-label">نص الرسالة  :</label>  
							<textarea  name="message"  class="form-control"  id="message" rows="70"> </textarea></div>
                        </div>
                     </div>

  
<a  href=""  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
 <input type="submit" value="إرسال" name="submit" class="btn btn-nor-primary btn-lg enable-overlay">

  
  
  
			  </div>
        </form>

      </div>
    </div>
  </div>
  </div>
 

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
         <script src="js/bootstrap.min.js"></script>
         <script src="js/appjs/event.js"></script>
         <script src="js/appjs/common.js"></script>
	   <script type="text/javascript" src="jQuery-TE/jquery-te-1.3.2.min.js" charset="utf-8"></script>
	      <script>
            $(function () {
                $("#includedContent").load("php/TopNav.php");
                $("#includedContent2").load("HTML/rightNav.html");
            });
           
	$('#message').jqte();
</script>

</body>

</html>