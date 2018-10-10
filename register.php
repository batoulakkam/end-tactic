<?php
// conect to database 
	require_once('php/connectTosql.php');
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");


    
// attribute to contan mesage
$masg = "";

  if (isset( $_POST['submit'])) {
    
     $name= $_POST['Name'];
     $email=$_POST['Email'];
     $password =$_POST['Password'];
     $Password2 =$_POST['Password2'];
     $gender=$_POST['gender'];
     $DOB=$_POST['Birthday'];
	  if (time() > strtotime('+18 years', strtotime($DOB))) {

	if($password !=$Password2)
           $masg = " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> حدث خطأ </strong> كلمات المرور غير متطابقة 
          </div> "; 
      else{
		
        
        $sql = mysqli_query($con, "SELECT organizer_ID FROM account WHERE emailOrg ='$email' ") or die(mysqli_error($con)) ;
		  
        if( mysqli_num_rows ($sql) > 0 ){
			
          $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> البريد الالكتروني الذي تحاول التسجيل به موجود مسبقا
       </div> ";
        }
		 else{

      $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890<>()!#%&/$*';
      $token= str_shuffle($token);
      $token= substr($token,0,10);


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
		
		$mail->Subject  =  'شكراً لتسجيل لتسجيلك في تكيك';
    $mail->Body = "أهلا بك في تكتيك 
   شكرا لتسجيلك في تكتيك  لتاكيد البريد الالكتروني http://localhost/tactic/confarmemail.php?email=$email&token=$token ";
   
		$mail->setfrom('tactic.event@gmail.com','tactic');
    $mail->AddAddress($email);
  
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    

          //add input to database
          

		if(!$mail->send()) 
		{
		
			$masg =" <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong>  غير متوقع ! فضلا حاول مرة اخرى.
       </div> ";
		} 
		else 
		{
			$sql = mysqli_query($con, "INSERT INTO  account (organizer_ID, emailOrg, passwordOrg ,isEmailconfirm,token,name_org,gender_org,DOB_org) VALUES ('','$email','$hashedPassword','0','$token','$name','$gender','$DOB')")or die(mysqli_error($con));
			$masg =" <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> تم التسجيل بنجاح </strong> لقد قمنا بارسال رسالة الى بريدك الكتروني يرجى التحقق منه لتأكيد الحساب  
       </div> ";
	
		}
    
        }

      }


}
else {
			   $masg = " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> حدث خطأ </strong> لايمكن التسجيل لمن هم دون 18 عام
          </div> ";
		
}
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
<title> الإشتراك </title>
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


  <!-------------------------------------------------------------------------->

</head>

<body>
<div class ="headerNav">
               <nav class="navbar navbar-inverse"  data-offset-top="10">
                
                <div class="container-fluid">
       
                 
              
                      <ul class="topnav">
					<a class="navbar-brand titleNav" href="#" style ="color:cornflowerblue;float:right;">تكتيك</a>
                    <li><a  href="register.php" >الإشتراك</a></li>
                    <li><a class="active" href="LogIn.php">تسجيل الدخول</a></li>
                    <li><a href="#contact">تواصل معنا</a></li>
                    <li><a href="#about">حولنا</a></li>  </ul>
     </div>
     </nav>
    </div>

  <!-- Body of register Page -->
  <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">الاشتراك  </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDiv" method="post"autocomplete="on">     
            
            <?php  if ($masg !="") echo $masg."<br>"; ?>
			<div class="col-md-12">
          <div class="form-group form-group-lg">
		<label for="eventName" class="control-label"> الاسم: </label> <label style="color:red">*&nbsp; </label>
		<input type="text" class="form-control" id="txtOrganizer" name="Name" placeholder="أدخل اسمك"   title="هذا الحقل مطلوب" required   >
        </div>
            </div>    
    <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label class="control-label">  البريد الإلكتروني: </label><label style="color:red">*&nbsp; </label>
  				<input type="email" class="form-control" id="email" name="Email" placeholder="أدخل بريدك الإلكتروني" autocomplete="on"  required >
 	 </div>
      </div>
  	<div class="col-md-12">
    <div class="form-group form-group-lg">
    <label for="txtMaxAttendee" class="control-label"> كلمة السر :<label style="color:red">*&nbsp; </label> </label>
	<input type="password" class="form-control" id="password"  name="Password" placeholder="أدخل كلمة السر" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="يجب أن تحتوي على الأقل على 8 أحرف و حروف صغيرة و كبيرة" required   >
  </div>
   </div>
	<div class="col-md-12">
    <div class="form-group form-group-lg">
     <label for="txtLocation" class="control-label">تأكيد كلمة السر :</label><label style="color:red">*&nbsp; </label>
	<input type="password" class="form-control" id="confirm_password" name="Password2" placeholder=" تأكيد كلمة السر "  autocomplete="off" required >
	</div>
   </div>
  	<div class="col-md-12">
    <div class="form-group form-group-lg">
     <label for="txtLocation" class="control-label">تاريخ الميلاد :</label><label style="color:red">*&nbsp; </label>
	<input type="date" value="2013-01-30" name="Birthday" class="form-control"    required   >
	</div>
   </div> 
	<div class="col-md-12">
    <div class="form-group form-group-lg ">
     <label class="control-label form-check" >الجنس :</label><label style="color:red">*&nbsp; </label>
	<section class="form-control" style="height:70px" >
	  <div class="form-check">
		 
          <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="انثى" checked>
          <label class="form-check-label" for="gridRadios1">
            انثى
		  </label>	
		</div>
		  <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="ذكر" >
          <label class="form-check-label" for="gridRadios1">
            ذكر
		  </label>
		</div>
		</section>	

	</div>
   </div>
  
<a  href="logIn.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
 <input type="submit" value="الاشترك" name="submit" class="btn btn-nor-primary btn-lg enable-overlay">

  
  
  
        
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

</body>

</html>