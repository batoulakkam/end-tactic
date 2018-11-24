<?php
require_once('php/connectTosql.php');
$masg = "";
if (isset($_SESSION['organizerID'])){
$id =$_SESSION['organizerID'];
    echo $id;
if (isset($_POST['submit'])){
$oldPassword = $_POST['Oldpassword'];
$password=$_POST['password'];
$confirm_password = $_POST['confirmPassword'];
$oldPassword = password_hash($oldPassword, PASSWORD_BCRYPT);
$query    = mysqli_query($con, "SELECT passwordOrg  FROM account WHERE passwordOrg = '$oldPassword'");
if($query){
if($password == $confirm_password ){
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$select =mysqli_query($con,"UPDATE account SET passwordOrg= '$hashedPassword' WHERE organizer_ID ='$id'  ");
 if ($select!=null){
 header('Location:LogIn.php?edit=true');
    exit();}}
else {
$masg= " <div class='alert alert-danger alert-dismissible'>
 <button type='button' class='close' data-dismiss='alert'>&times;</button>
 <strong> فشل</strong>   تحقق كلمة المرور من تطابق كلمة المرور
 </div> ";}}
    else {
        $masg= " <div class='alert alert-danger alert-dismissible'>
 <button type='button' class='close' data-dismiss='alert'>&times;</button>
 <strong> فشل</strong>    يرجى التأكد من كلمة المرور القديمة 
 </div> ";
    }
}

 else {}   
}
else{header('Location:LogIn.php');}


?>
<!DOCTYPE html>
<html lang="ar">
<head>
<title> تعديل كلمة المرور </title>
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

  <link rel="shortcut icon" href="image/logo.png" type="image/x-icon" />


  <!-------------------------------------------------------------------------->

</head>
<body>
<!-- <div id="includedContent"></div>
  <div id="includedContent2"></div>
	 Body of register Page -->
<div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">تعديل كلمة المرور </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivReset" method="post"autocomplete="on" id="resetPassword">     
            
            <?php  if ($masg !="") echo $masg."<br>"; ?>
              <div class="col-md-12">
    <div class="form-group form-group-lg">
    <label for="txtMaxAttendee" class="control-label"> كلمة المرور القديمة  :<label style="color:red">*&nbsp; </label> </label>
	<input type="password" class="form-control" id="password"  name="Oldpassword" placeholder="أدخل كلمة السر" autocomplete="on"  >
  </div>
   </div>
              
              
      	<div class="col-md-12">
    <div class="form-group form-group-lg">
    <label for="txtMaxAttendee" class="control-label">كلمة المرور الجديدة  :<label style="color:red">*&nbsp; </label> </label>
	<input type="password" class="form-control" id="password"  name="password" placeholder="أدخل كلمة السر" autocomplete="on"  >
  </div>
   </div>
	<div class="col-md-12">
    <div class="form-group form-group-lg">
     <label for="txtLocation" class="control-label">تأكيد كلمة المرور :</label><label style="color:red">*&nbsp; </label>
	<input type="password" class="form-control" id="confirm_password" name="confirmPassword" placeholder="تأكيد كلمة السر "  autocomplete="off"  >
	</div>
   </div>
	 <input type="submit" value="تعديل كلمة المرور " name="submit" class="btn btn-nor-primary btn-lg enable-overlay">
									 
         </form>

      </div>
    </div>
  </div>
  </div>
 

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/resetPassword.js"></script>
  <script src="js/appjs/common.js"></script>
   
       <script src="js/jquery.validate.min.js"></script>
      <script>
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script> 

</body>

</html>