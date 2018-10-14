<?php
require_once 'php/connectTosql.php';
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";
$masg = "";
if (isset($_POST['Email']) and isset($_POST['Password'])) {

 $orgEmail = $_POST['Email'];
 $password = $_POST['Password'];
 $query    = mysqli_query($con, "SELECT * FROM account WHERE `emailOrg` = '$orgEmail'");
 $row      = mysqli_fetch_array($query);
 if (password_verify($password, $row['passwordOrg']) && ($row['isEmailconfirm']==="1")) {

  if ($query) {

   $_SESSION['organizerID']  = $row['organizer_ID'];
   $_SESSION['OrgName']      = $row['name_org'];
   $_SESSION['orgEmail']     = $row['emailOrg'];
   $_SESSION['password']     = $row['passwordOrg'];
   $_SESSION['emailconfirm'] = $row['isEmailconfirm'];
   header('Location:manageEvent.php');
   exit();
  } // end if
  else {
   header('Location:LogIn.php?error=false');
   exit();}
 }
 $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  تحقق من كلمة المرور
       </div> ";
}
if (isset($_GET['error'])) {
 $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  من تطابق كلمة المرور
       </div> ";}
if (isset($_GET['confirm']) == false) {
 $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong> يرجى تأكيد البريد الالكتروني
       </div> ";}

if (isset($_GET['edit'])) {
 if ($_GET['edit'] = true) {
  $masg = " <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        تم تغير كلمة المرور بنجاح يرجى تسجيل الدخول
       </div> ";
 }

}

if (isset($_GET['register'])) {
 if ($_GET['register'] = true) {
  $masg = " <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> تم العملية بنجاح </strong> شكرا لتسجيلك في تكتيك
       </div> ";
 }
}

?>
<!DOCTYPE html>
<html lang="ar">
<head>
<title> تسجيل الدخول </title>
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
                    <li><a href="#about">حولنا</a></li>
                          </ul>


                </div>
              </nav>
    </div>

  <!-- Body of register Page -->
  <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">تسجيل الدخول   </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivLogIn" method="post"autocomplete="on">
     <?php if ($masg != "") {
 echo $masg . "<br>";
}
?>


  <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label class="control-label">  البريد الإلكتروني: </label><label style="color:red">*&nbsp; </label>
  				<input type="email" class="form-control" id="email" name="Email" placeholder="أدخل بريدك الإلكتروني" autocomplete="on"   >
 	 </div>
      </div>
    	<div class="col-md-12">
    <div class="form-group form-group-lg">
    <label for="txtMaxAttendee" class="control-label"> كلمة السر :<label style="color:red">*&nbsp; </label> </label>
	<input type="password" class="form-control" id="password"  name="Password" placeholder="أدخل كلمة السر" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="يجب أن تحتوي على الأقل على 8 أحرف و حروف صغيرة و كبيرة"    >
  </div>
   </div>
   	<div class="col-md-12">

<a   href="resetPassword.php">نسيت كلمة المرور؟</a>

 <input type="submit" value="تسجيل الدخول" name="submit" class="btn btn-nor-primary btn-lg enable-overlay">

			  </div>



        </form>

      </div>
    </div>
  </div>
  </div>


  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/LogIn.js"></script>
  <script src="js/appjs/common.js"></script>

</body>

</html>