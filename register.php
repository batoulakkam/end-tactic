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
	if($password !=$Password2)
           $masg = " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> حدث خطأ </strong> كلمات المرور غير متطابقة 
          </div> "; 
      else{
		
        
        $sql = mysql_query( "SELECT organizer_ID FROM account WHERE emailOrg ='$email' ") or die(mysql_error()) ;
		  
        if( mysql_num_rows ($sql) > 0 ){
			
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
    $mail->Body = 
    "أهلا بك في تكتيك 
   شكرا لتسجيلك في تكتيك  لتاكيد البريد الالكتروني  href='http://localhost/tactic-master/confarmemail.php?email=$email&token=$token' ";
  
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
			$sql = mysql_query( "INSERT INTO  account (organizer_ID, emailOrg, passwordOrg ,isEmailconfirm,token,name_org,gender_org,DOB_org) VALUES ('','$email','$hashedPassword','0','$token','$name','$gender','$DOB')")or die(mysql_error());
			$masg =" <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> تم التسجيل بنجاح </strong> لقد قمنا بارسال رسالة الى بريدك الكتروني يرجى التحقق منه لتأكيد الحساب  
       </div> ";
	
		}
        
        
        
        }

      }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> الإشتراك </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/layouts/custom.css">
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <!-- lobrary of icon  fa fa- --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <!-- lobrary of style bootstrab 3  --->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- lobrary of style bootstrab 4  --->

    
    <!-------------------------------------------------------------------------->

    <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />

</head>
<body>
<div class ="headerNav">
               <nav class="navbar navbar-inverse"  data-offset-top="10">
                
                <div class="container-fluid">
       
                 
              
                      <ul class="topnav">
          <a class="navbar-brand titleNav" href="#" style ="color:cornflowerblue;float:right;"> &nbsp; &nbsp; تكتيك</a>
          
          <ul >
            
                   <li><a class="active" href="register.html">الإشتراك  </a></li>
                    <li><a href="LogIn.html">تسجيل الدخول</a></li>
                    <li><a href="#contact">تواصل معنا</a></li>
                    <li><a href="#about">حولنا</a></li>         
                          </ul>
						  

                </div>
              </nav>
    </div>

  <!-- Body of register Page -->
  <div class="mainContent">
    <div class="pageTitel">
       <h1> الإشتراك   </h1>
          </div>
    <div class ="container">

        <form action="" method= "post" class="formDiv" autocomplete="on">

          
            
            <table class="tabelForm" >
            <?php  if ($masg !="") echo $masg."<br>"; ?>
            
     
  <tr>
    <td class="rightTd">  <input type="text" id="name" name="Name" placeholder="أدخل اسمك" style=" width:400px"  title="هذا الحقل مطلوب" required required dir ="rtl" ></td>
      <td class="leftTd">  <label style="color:red">*&nbsp; </label><label for="name"> : الاسم </label>  </td>
  </tr>
  
  <tr>
    <td>   <input type="email" id="email" name="Email" placeholder="أدخل بريدك الإلكتروني" autocomplete="on" style=" width:400px" required  required dir ="rtl"></td>
    <td><label style="color:red">*&nbsp; </label><label for="email"> : البريد الإلكتروني </label></td>
  </tr>
  
  <tr>
    <td><input type="password" id="password"  name="Password" placeholder="أدخل كلمة السر" autocomplete="on" style=" width:400px" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="يجب أن تحتوي على الأقل على 8 أحرف و حروف صغيرة و كبيرة" required dir ="rtl"></td>
    <td>  <label style="color:red">*&nbsp; </label><label for="password"> : كلمة السر </label></td>
  </tr>
  
  <tr>
    <td><input type="password" id="confirm_password" name="Password2" placeholder="تأكيد كلمة السر "  autocomplete="off"style=" width:400px"required required dir ="rtl"></td>
    <td>  <label style="color:red">*&nbsp; </label> <label for="confirm_password"> : تأكيد كلمة السر </label></td>
  </tr>
  
  <tr>
    <td><input type="date" name="Birthday"  style=" width:400px" required dir ="rtl"></td>
    <td> <label style="color:red">*&nbsp; </label> <label for="birthday"> : تاريخ الميلاد  </label></td>
  </tr>
 <tr>

    <td> <label class="radio-inline  "> أنثى &nbsp </label> <input type="radio" name="gender" value="female" > 
	<label class="radio-inline " > ذكر &nbsp </label> <input type="radio" name="gender" value="male" checked> 
  </td>
    <td> <label style="color:red">*&nbsp; </label> <label for="gender"> : الجنس</label></td>	
</tr>
 
<tr>
   <td> <input type="reset" value="الغاء" class="btn btn-danger">
   <input type="submit" value="تسجيل" name="submit" class="btn btn-primary" center id="submit" >
     </td>
  </tr> 

  
  
  
  
  
  

</table>
        
  </form>

    </div>        
  </div>

  <!-- end of  register inputs -->

<script src="js/javaScriptfile.js"></script>
</body>
</html>