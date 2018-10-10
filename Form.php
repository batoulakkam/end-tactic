<?php
include('php/connectTosql.php');
 if(isset($_GET['token'])){
   $token = $_GET['token'];
   $query = mysqli_query($con,"SELECT * FROM registration_form WHERE token = '$token'");
	 $field [] ="";
	 $choied[]="";
	 $requierd[] ="";
	 $index = 0;
	 $eventID ="";
	if (mysqli_num_rows($query)<=10){
	while($row =mysqli_fetch_array($query)){
	$eventID = $row[6];
	$field [$index] = $row[1];
	$choied[$index] = $row[2];
	$requierd[$index] = $row['required_field'];
	$index++;	
	}
	 
	}
	 $length = count($field);
$query2 = mysqli_query($con,"SELECT name_Event ,descrption_Event  FROM event WHERE event_ID = '$eventID'");
	$row2 =mysqli_fetch_array($query2);
	 $eventName = $row2['name_Event'];
	 $eventDis = $row2['descrption_Event'];
 }
$name =""; $email ="";
$phone="";
$age="";
$gender="";
$ID="";$job="";$edu="";$VIP="";$nationality="";
if (isset($_POST['register'])){
$name= $_POST['nameAttendee'];
$email=$_POST['emailAttendee'];
$phone=$_POST['phoneAttendee'];
$age=$_POST['ageAttendee'];
$gender=$_POST['genderAttendee'];
$ID =$_POST['IDAttendee'];
$job=$_POST['jobAttendee'];
$edu=$_POST['eduAttendee'];
$VIP=$_POST['VIPAttendee'];
$sql = mysqli_query($con, "INSERT INTO attendee (Attendee_ID,email_Att, name_Att,phone_Att, DOB_Att ,gender_Att,eductional_Level,career_Att,	national_ID_Att,VIP_code,form,	event_ID) VALUES ('','$email','$name','$phone','$age','$gender','$edu','$job','$ID','$VIP','$token','$eventID' )") or die(mysqli_error($con));
if($sql){
$query3 = mysqli_query($con,"SELECT MAX(Attendee_ID) FROM attendee")or die(mysqli_error($con));
$rowID =mysqli_fetch_array($query3);
$attendeeID = $rowID['0'];
header("location:confirmRegisterEvent.php?attendeeID=$attendeeID");}
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
		<h4><?php echo $eventDis; ?></h4>
		<form action="" class="formDiv" method="post">
			<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> الاسم</label><label style="color:red">*&nbsp; </label>
             <input type="text" class="form-control"  name="nameAttendee"
               required data-errormessage-value-missing="هذا الحقل مطلوب يرجى إدخال الاسم" >
              </div>
            </div>
      		<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> البريد الالكتروني</label><label style="color:red">*&nbsp; </label>
             <input type="email" required="" oninvalid="this.setCustomValidity('هذا الحقل مطلوب يرجى إدخال الايميل')" oninput="setCustomValidity('')" name="emailAttendee" class="form-control" >
              </div>
            </div>
			<?php  if( $length>2)
				if($field [2] == 'الهاتف' || $requierd [2] == 1 )
	echo '<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label  class="control-label"> رقم الهاتف</label><label style="color:red">*&nbsp; </label>
             <input type="text" required class="form-control" id="txtPhone"  name="phoneAttendee"
                   >
              </div>
            </div>';
		else {
			echo '<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> رقم الهاتف</label>
             <input type="text" class="form-control" id="txtSubEventName"  name="phoneAttendee">
              </div>
            </div>';
		}
	

	    if( $length>3)
		if($field [3] == 'العمر' || $requierd [3] == 1){
	echo '<div class="col-md-12">
     <div class="form-group form-group-lg">
      <label  class="control-label"> العمر</label><label style="color:red">*&nbsp; </label>
       <input type="date" required class="form-control" id="txtSubEventName"  name="ageAttendee" 
	   value="1995-12-29"  >
          </div>
            </div>';}
		else {
			echo '<div class="col-md-12">
     <div class="form-group form-group-lg">
      <label for="eventName" class="control-label"> العمر</label>
       <input type="date" class="form-control" id="txtSubEventName"  name="ageAttendee">
          </div>
            </div>';}
			if( $length>4)
		if($field [4] == 'الجنس' || $requierd[4] == 1 )
	echo '
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
   				</div>';
		else {
			
			echo '
			<div class="col-md-12">
			 <div class="form-group form-group-lg ">
     		  <label class="control-label form-check" >الجنس :</label>
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
   				</div>';
			
			
		}
		if( $length>5)
		if($field [5] == 'التعليم' || $requierd [5] == 1  )
	echo '
      <div class="col-md-12">
          <div class="form-group form-group-lg">
             <label class="control-label"> مستوى التعليم</label><label style="color:red">*&nbsp; </label>
                <select id="education" name="eduAttendee" class="form-control" required oninvalid="this.setCustomValidity("هذا الحقل مطلوب يرجى اختيار مستوى التعليم")>
                  <option value= "غير متعلم" >غير متعلم</option>
                  <option value="ثانوي" >ثانوي</option>
                  <option value="بكالوريوس" >بكالوريوس</option>
                  <option value="ماستر" >ماستر</option>
                  <option value="دكتواه" >دكتواه</option>
                  
                </select>
              </div>
			</div>';
		else {
			echo '
      <div class="col-md-12">
          <div class="form-group form-group-lg">
             <label for="eventName" class="control-label"> مستوى التعليم</label>
                <select id="education" name="eduAttendee" class="form-control">
                  <option value= "غير متعلم" >غير متعلم</option>
                  <option value="ثانوي" >ثانوي</option>
                  <option value="بكالوريوس" >بكالوريوس</option>
                  <option value="ماستر" >ماستر</option>
                  <option value="دكتواه" >دكتواه</option>
                  
                </select>
              </div>
			</div>';
		}
		if( $length>6)
		if($field [6] == 'المهنة' || $requierd [6] == 1  )
			echo '
      		<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label class="control-label"> المهنة</label> <label style="color:red">*&nbsp; </label>
             <input type="text" class="form-control" required oninvalid="this.setCustomValidity("هذا الحقل مطلوب يرجى إدخال المهنة")  name="jobAttendee"
                  >
              </div>
            </div>';
			else{
				echo '
      		<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label  class="control-label"> المهنة</label>
             <input type="text" class="form-control" id="txtjob"  name="jobAttendee">
              </div>
            </div>';
			}
			
     		/*<div class="col-md-12">
            <div class="form-group form-group-lg">  
			<label for="eventName" class="control-label">الجنسية</label>
           <select id="education" name="education" class="form-control">
            <option value=""></option>
             </select>
			 </div>
            </div>';*/
		if( $length>7)
		if($field [7] == 'الهوية' || $requierd [7] == 1 )
	echo '
			<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label">رقم الهوية</label> <label style="color:red">*&nbsp; </label>
             <input type="text" class="form-control" id="txtIDAttendee"  name="IDAttendee"
                  required oninvalid="this.setCustomValidity("هذا الحقل مطلوب يرجى إدخال رقم الهوية")>
              </div>
            </div>';
			else{
				echo '
					<div class="col-md-12">
					<div class="form-group form-group-lg">
					 <label for="eventName" class="control-label">رقم الهوية</label>
					 <input type="text" class="form-control"   name="IDAttendee">
					  </div>
					</div>';
			    }
			if( $length>8 )
		if($field [8] == 'الاشخاص المهمة' || $requierd [8] == 1 )
	echo '
			<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label">كود الاشخاص المهمين</label><label style="color:red">*&nbsp; </label>
             <input type="text" class="form-control" id="txtVIPAttendee"  name="VIPAttendee"
                  required oninvalid="this.setCustomValidity("هذا الحقل مطلوب يرجى إدخال كود الاشخاص المهمين")>
              </div>
            </div>';
		else {
			echo '
			<div class="col-md-12">
            <div class="form-group form-group-lg">
             <label for="eventName" class="control-label">كود الاشخاص المهمين</label>
             <input type="text" class="form-control" id="txtVIPAttendee"  name="VIPAttendee"
                  >
              </div>
            </div>';
		}
			
			?>
	
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
