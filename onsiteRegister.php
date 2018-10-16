<?php 
include('php/connectTosql.php');
$eventName="";
$masg="";
 if(isset($_GET['eID'])){
   $eID = $_GET['eID'];
$query = mysqli_query($con, "SELECT * FROM event WHERE event_ID = '$eID'") or die(mysqli_error($con));
$row =mysqli_fetch_array($query);
$eventName = $row['name_Event'];
if (isset($_POST['register'])){
$name= $_POST['nameAttendee'];
$email=$_POST['emailAttendee'];
$phone = $_POST['phoneAttendee'];
  $sql = mysqli_query($con, "SELECT Attendee_ID FROM attendee WHERE email_Att ='$email' ") or die(mysqli_error($con)) ;
if( mysqli_num_rows ($sql) > 0 ){
			
          $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> البريد الالكتروني الذي تحاول التسجيل به موجود مسبقا
       </div> ";
		
        }
else{
	$sql = mysqli_query($con, "INSERT INTO attendee (Attendee_ID,email_Att, name_Att, phone_Att, event_ID) VALUES ('','$email','$name','$phone','$eID' )") or die(mysqli_error($con));
if($sql){
$query3 = mysqli_query($con,"SELECT MAX(Attendee_ID) FROM attendee")or die(mysqli_error($con));
$rowID =mysqli_fetch_array($query3);
$attendeeID = $rowID['0'];
header("location:confirmRegisterEvent.php?attendeeID=$attendeeID");}}
	
}
 }
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<title>نموذج التسجيل  </title>
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
          <h4 class="panelTitle"> التسجيل في <?php echo $eventName; ?> </h4>
        </div>
        <div class="panel-body">
			<form action="" class="formDiv" method="post">
			<?php  if ($masg !="") echo $masg."<br>"; ?>
			<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> الاسم : </label><label style="color:red">*&nbsp; </label>
             <input type="text" class="form-control"  name="nameAttendee"
               required data-errormessage-value-missing="هذا الحقل مطلوب يرجى إدخال الاسم" >
              </div>
            </div>
      		<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> البريد الالكتروني : </label><label style="color:red">*&nbsp; </label>
             <input type="email" required="" oninvalid="this.setCustomValidity('هذا الحقل مطلوب يرجى إدخال الايميل')" oninput="setCustomValidity('')" name="emailAttendee" class="form-control" >
              </div>
            </div>
			 <div class="col-md-12">
            <div class="form-group form-group-lg">
             <label  class="control-label"> الهاتف : </label><label style="color:red">*&nbsp; </label>
             <input type="text" required="" oninvalid="this.setCustomValidity('هذا الحقل مطلوب يرجى إدخال الايميل')" oninput="setCustomValidity('')" name="phoneAttendee" class="form-control" >
              </div>
            </div>
			
			 <input type="submit" value="التسجيل" name="register" class="btn btn-nor-primary btn-lg enable-overlay">


</form>
 </div>  
 </div>
	  </div></div>


  <!-- end of  register inputs -->
 <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/event.js"></script>
  <script src="js/appjs/common.js"></script>


</body>

</html>
