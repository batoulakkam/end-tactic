<?php
// conect to database 
	require_once('php/connectTosql.php');
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");
	$attendeeID ='';
	$email_Att="";
	if(isset($_GET['AttendeeID'])){
	$attendeeID = $_GET['AttendeeID'];
	$sql = mysqli_query($con, "SELECT * FROM attendee WHERE Attendee_ID ='$attendeeID' ") or die(mysqli_error($con)) ;
	$row = mysqli_fetch_array($sql);
	$email_Att = $row ['email_Att'];
				   }

    
// attribute to contan mesage
$masg = "";
$headers="";


  if (isset( $_POST['submit'])) {
    
     $emailTo= $_POST['emailTo'];
     $subject =$_POST['subject'];
	 $massege =$_POST['message'];
	 $logo =$_POST['logo'];
     $username=$row['name_Att'];
	$mensaje = file_get_contents('emailTamplet.html');
	$mensaje =  str_replace("{{USERNAME}}",$username,$mensaje);
	$mensaje =  str_replace("{{eventName}}",$username,$mensaje);	 
	$mensaje =  str_replace("{{eventDate}}",$username,$mensaje);	 
	$mensaje =  str_replace("{{subject}}",$body,$mensaje);	

  
	  
	  
$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->CharSet =  "utf-8";
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; 
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';                             // Enable SMTP authentication
$mail->Username = 'tactic.gp@gmail.com';                   // SMTP username
$mail->Password = '1234567890Qw';               // SMTP password                       
//$mail->addReplyTo('<no-reply@mywebsite.com>', 'tactic');  //Set an alternative reply-to address
$mail->addAddress('marwa.salahi.790@gmail.com','tactic');
$mail->Subject = 'Here is the subject';
$mail->Body    = $mensaje;
$mail->AltBody = $mensaje; //add input to database
	 if($mail->send()) 
		{
      
echo $mensaje;}
		if(!$mail->send()) 
		{
		
			$masg =" <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong>  غير متوقع ! فضلا حاول مرة اخرى.
       </div> ";
		} 
	
    
        }


?>

<!DOCTYPE html>
<html lang="ar">
<head>
<title> ارسال بريد الكتروني </title>
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
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="editor.css" type="text/css" rel="stylesheet"/>


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
         	<div class="col-md-12">
          <div class="form-group form-group-lg">
		<?php  if ($masg !="") echo $masg."<br>"; ?>
		<label for="eventName" class="control-label">المستقبل : </label> 
		
		<select class="form-control" id="txtOrganizer" name="emailTo" >
			<option value="<?php echo $email_Att ;?>">
				<?php echo $email_Att ;?>
				
			</option>
			<option value="">
				إرسال للجميع 
				
			</option>
			  </select> 
        </div>
            </div>    
    <div class="col-md-12">
              <div class="form-group form-group-lg"  >
                <label class="control-label"> الموضوع : </label>
  				<input type="text" class="form-control" id="email" name="subject"  >
 	 </div>
      </div>
  	<div class="col-md-12">
    <div class="form-group form-group-lg">
<pre>
<span><b>عزيزي :</b> </span>
<span><b>هذا البريد مرسل من قبل منظمو فعالية : </b> </span>
</pre>
		</div>
			  </div>
			 <!-- 	<div class="col-md-12">
    <div class="form-group form-group-lg">
			<img id="box" src="#" alt="your image" style=" visibility: hidden" />
			<input type="file" name= "logo" id="images"
				   onclick="toggleMenu2()" onchange="readURL(this);" >
			
					</div>
			  </div>-->
			  	<div class="col-md-12">
    <div class="form-group form-group-lg">
	<label for="txtMaxAttendee" class="control-label">نص الرسالة  :</label>  
    <textarea  name="message"  class="form-control" rows="10"  ></textarea>
		
    
	
	</div>
   </div> 

  
<a  href=""  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
 <input type="submit" value="إرسال" name="submit" class="btn btn-nor-primary btn-lg enable-overlay">


  
        
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
		<script src="editor.js"></script>
	<script src="js/javaScriptfile.js"></script>
		<script>
			$(document).ready(function() {
        $("#txtEditor").Editor();
        
			});
			function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#box')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
		</script>

</body>

</html>