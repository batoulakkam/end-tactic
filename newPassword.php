<?php
require_once('php/connectTosql.php');
$masg = "";
if(isset($_GET['key'])){
// تكوين جديدة مشان مايرجع يفوت من نفس الرابط ويرجع يعدل 
 $tokenUp = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890<>()!#%&/$*';
 $tokenUp= str_shuffle($tokenUp);
 $tokenUp= substr($tokenUp,0,10);
if (isset($_POST['password']) && isset($_POST['confirmPassword'])){
$password=$_POST['password'];
$confirm_password = $_POST['confirmPassword'];
$con = mysqli_connect('localhost','root','','tactic');
if($password == $confirm_password ){
$token=$_GET['key'];	
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$select =mysqli_query($con,"UPDATE account SET passwordOrg= '$hashedPassword', token = '$tokenUp'  WHERE token ='$token'");
 if ($select!=null){
 header('Location:LogIn.php?edit=true');
    exit();}}
else {
$masg= " <div class='alert alert-danger alert-dismissible'>
 <button type='button' class='close' data-dismiss='alert'>&times;</button>
 <strong> فشل</strong>  من تطابق كلمة المرور
 </div> ";}}	
}
else{header('Location:LogIn.php');}


?>
<!DOCTYPE html>
<html lang="ar">
<head>
<title> ادخال كلمة المرور </title>
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

	 <!-- Body of register Page -->
<div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">استعادة كلمة المرور </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivReset" method="post"autocomplete="on">     
            
            <?php  if ($masg !="") echo $masg."<br>"; ?>
      	<div class="col-md-12">
    <div class="form-group form-group-lg">
    <label for="txtMaxAttendee" class="control-label"> كلمة السر :<label style="color:red">*&nbsp; </label> </label>
	<input type="password" class="form-control" id="password"  name="password" placeholder="أدخل كلمة السر" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="يجب أن تحتوي على الأقل على 8 أحرف و حروف صغيرة و كبيرة" required   >
  </div>
   </div>
	<div class="col-md-12">
    <div class="form-group form-group-lg">
     <label for="txtLocation" class="control-label">تأكيد كلمة السر :</label><label style="color:red">*&nbsp; </label>
	<input type="password" class="form-control" id="confirm_password" name="confirmPassword" placeholder="تأكيد كلمة السر "  autocomplete="off"  >
	</div>
   </div>
	 <input type="submit" value="تغيير كلمة المرور " name="submit" class="btn btn-nor-primary btn-lg enable-overlay">
									 
         </form>

      </div>
    </div>
  </div>
  </div>
 

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/newPassword.js"></script>
  <script src="js/appjs/common.js"></script>

</body>

</html>