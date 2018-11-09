<?php
include('php/connectTosql.php');
if (isset($_GET['token'])) {
    $token      = $_GET['token'];
    $query      = mysqli_query($con, "SELECT * FROM registration_form WHERE token = '$token'");
    $field[]    = "";
    $choied[]   = "";
    $requierd[] = "";
    $index      = 0;
    $eventID    = "";
    $masg       = "";
	$genderQuery = mysqli_query($con, "SELECT * FROM gender ");
	$nationalityQuery = mysqli_query($con, "SELECT * FROM nationality ");
	$educationalLevelQuery = mysqli_query($con, "SELECT * FROM educationallevel");
	
    while ($row = mysqli_fetch_array($query)) {
        $eventID          = $row['event_ID'];
        $field[$index]    = $row['name_of_field'];
        $choied[$index]   = $row['selected_field'];
        $requierd[$index] = $row['required_field'];
        $Optional[$index] = $row['optional'];
        $index++;
    } //$row = mysqli_fetch_array($query)
    $length    = count($field);
    $query2    = mysqli_query($con, "SELECT name_Event ,descrption_Event  FROM event WHERE event_ID = '$eventID'");
    $row2      = mysqli_fetch_array($query2);
    $eventName = $row2['name_Event'];
    $eventDis  = $row2['descrption_Event'];
} //isset($_GET['token'])
$name        = "";
$email       = "";
$phone       = "";
$age         = "";
$gender      = "";
$ID          = "";
$job         = "";
$natiAttendee= ""; 
$edu         = "";
$VIP         = "";
$optional    = "";
if (isset($_POST['register'])) {
    $name  = $_POST['nameAttendee'];
    $email = $_POST['emailAttendee'];
    $sql = mysqli_query($con, "SELECT id FROM attendee WHERE email ='$email' ") or die(mysqli_error($con));
    if (mysqli_num_rows($sql) > 0) {
        $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> البريد الالكتروني الذي تحاول التسجيل به موجود مسبقا
       </div> ";
    } //mysqli_num_rows($sql) > 0
    else {
        if (isset($_POST['phoneAttendee']))
            $phone = $_POST['phoneAttendee'];
        if (isset($_POST['ageAttendee']))
            $age = $_POST['ageAttendee'];
        if (isset($_POST['gender_Att']))
            $gender = $_POST['gender_Att'];
        if (isset($_POST['IDAttendee']))
            $ID = $_POST['IDAttendee'];
        if (isset($_POST['jobAttendee']))
            $job = $_POST['jobAttendee'];
        if (isset($_POST['eduAttendee']))
            $edu = $_POST['eduAttendee'];
        if (isset($_POST['VIPAttendee']))
            $VIP = $_POST['VIPAttendee'];
        if (isset($_POST['natiAttendee']))
            $natiAttendee = $_POST['natiAttendee'];
        if (isset($_POST['optional']))
            $optional = $_POST['optional'];
        $sql = mysqli_query($con, "SELECT VIPCode FROM event WHERE event_ID = '$eventID' ") or die(mysqli_error($con));
        $rows = mysqli_fetch_array($sql);
        if ($VIP != $rows['VIPCode'] && $VIP != '') {
            $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> كود الاشخاص المهمين الذي أدخلته غير صحيح 
       </div> ";
        } //$VIP != $rows['VIPCode'] && $VIP != ''
        else {
            if ($VIP == $rows['VIPCode'] || $VIP == "") {
				$sql = mysqli_query($con, "INSERT INTO attendee (Id,email, name,phone, DOB ,genderId,educationalLevelId,jobTitle,nationalityId,nationalId,VIPCode,optional,form,   eventId) VALUES ('','$email','$name','$phone','$age','$gender','$edu','$job','$natiAttendee','$ID','$VIP','$optional','$token','$eventID' )") or die(mysqli_error($con));
				
                if ($sql) {
                    $query3 = mysqli_query($con, "SELECT MAX(Id) FROM attendee") or die(mysqli_error($con));
                    $rowID      = mysqli_fetch_array($query3);
                    $attendeeID = $rowID['0'];
                    
                    header("location:imagetext.php?attendeeID=$attendeeID");
                   // header("location:confirmRegisterEvent.php?attendeeID=$attendeeID");
                } //$sql
            } //$VIP == $rows['VIPCode'] || $VIP == ""
        }
    }
} //isset($_POST['register'])
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
      <form action=""  id="formDiv" method="post">
      <?php  if ($masg !="") echo $masg."<br>"; ?>
      <div class="col-md-12">
         <div class="form-group form-group-lg">
            <label  class="control-label"> الاسم</label><label style="color:red">*&nbsp; </label>
            <input type="text" class="form-control" id="nameAttende" name="nameAttendee"  >
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group form-group-lg">
            <label  class="control-label"> البريد الالكتروني</label><label style="color:red">*&nbsp; </label>
            <input type="email" id="emailAttende" name="emailAttendee" class="form-control" >
         </div>
      </div>
			<?php
				  for ($x = 2; $x < $length; $x++) {
					if ($field[$x] == 'الهاتف') {
						echo '<div class="col-md-12">
												<div class="form-group form-group-lg">
												<label  class="control-label"> رقم الهاتف</label>'
							. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'<input type="text" class="form-control"'. ($requierd[$x] == 1?  'id="phoneAttende" ':''). ' name="phoneAttendee">
												</div>
												</div>';
					} //$field[$x] == 'الهاتف' && $requierd[$x] == 1
					 
					if ($field[$x] == 'العمر' ) {
						echo '<div class="col-md-12">
													<div class="form-group form-group-lg">
													<label  class="control-label"> العمر</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
													<input type="date" required class="form-control"'. ($requierd[$x] == 1?' id="ageAttende" ':'').' name="ageAttendee" 
													value="1995-12-29"  >
														</div>
															</div>';
						
					} //$field[$x] == 'العمر' && $requierd[$x] == 1
					
					if ($field[$x] == 'الجنس') {
						echo '<div class="col-md-12">
												<div class="form-group form-group-lg ">
												<label class="control-label form-check" >الجنس :</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
												<select '. ($requierd[$x] == 1? 'id="gender_At"':'').' name="gender_Att" class="form-control" >';
													 
echo '<option  value="-1" ' . ($genderId === -1 ? ' selected="selected"' : '') . '>الرجاء الاختيار</option>';

while ($row = mysqli_fetch_array($genderQuery)){
 echo '<option  value="' . $row['Id'] . '" ' . ($genderId == $row['Id'] ? ' selected="selected"' : '') . '>' . $row['Name'] . '</option>';}
 
                                   

												echo'	</select>
														</div>
														</div>';
						
					} //$field[$x] == 'الجنس' && $requierd[$x] == 1

					if ($field[$x] == 'التعليم' ) {
						echo '
							<div class="col-md-12">
								<div class="form-group form-group-lg">
									<label class="control-label"> مستوى التعليم</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
										<select '. ($requierd[$x] == 1? 'id="eduAttende"':'').' name="eduAttendee" class="form-control" >';
						echo '<option  value="-1" ' . ($educationalLevelId === -1 ? ' selected="selected"' : '') . '>الرجاء الاختيار</option>';

while ($row = mysqli_fetch_array($educationalLevelQuery)){
 echo '<option  value="' . $row['Id'] . '" ' . ($educationalLevelId == $row['Id'] ? ' selected="selected"' : '') . '>' . $row['Name'] . '</option>';}
										

										echo '</select>
									</div>
									</div>';
					} //$field[$x] == 'التعليم' && $requierd[$x] == 1
					
					if ($field[$x] == 'المهنة') {
						echo '
							  <div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label class="control-label"> المهنة</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
							 <input type="text" class="form-control" '. ($requierd[$x] == 1? 'id="jobAttende"':'').' name="jobAttendee"
								  >
							  </div>
							</div>';
					} //$field[$x] == 'المهنة' && $requierd[$x] == 1
 
					if ($field[$x] == 'الجنسية') {
						echo '<div class="col-md-12">
							<div class="form-group form-group-lg">  
							<label class="control-label">الجنسية</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
						   <select '. ($requierd[$x] == 1? ' id="natiAttende"':'').' name="natiAttendee" class="form-control">';
						echo	'<option  value="-1" ' . ($nationalityId === -1 ? ' selected="selected"' : '') . '>الرجاء الاختيار</option>';

while ($row = mysqli_fetch_array($nationalityQuery)){
 echo '<option  value="' . $row['Id'] . '" ' . ($nationalityId == $row['Id'] ? ' selected="selected"' : '') . '>' . $row['Name'] . '</option>';}
									
							echo '</select>
							 </div>
							</div>';
					} //$field[$x] == 'الجنسية'
					//حطيت الطول لان بدي شوف اخر عنصر اذا ريكوايرد لو 
					if ($field[$x] == 'الهوية') {
						echo '
								<div class="col-md-12">
								<div class="form-group form-group-lg">
								 <label class="control-label">رقم الهوية</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
								 <input type="text" class="form-control" '. ($requierd[$x] == 1? 'id="IDAttende"':'').'  name="IDAttendee"
									 >
								  </div>
								</div>';
					} //$field[$x] == 'الهوية' && $requierd[$length - 1] == 1
					 
					if ($field[$x] == 'الاشخاص المهمة') {
						echo '
							<div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label class="control-label">كود الاشخاص المهمين</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
							 <input type="text" class="form-control" '. ($requierd[$x] == 1? 'id="txtVIPAttendee"':'').' name="VIPAttendee">
							  </div>
							</div>';
					} //$field[$x] == 'الاشخاص المهمة' && $requierd[$x] == 1
					
					if ($Optional[$x] == 1) {
						echo '
										<div class="col-md-12">
										<div class="form-group form-group-lg">
										<label for="eventName" class="control-label">' . $field[$x] . '</label>'. ($requierd[$x] == 1? '<label style="color:red">*&nbsp; </label>':'') .'
										<input type="text" class="form-control" '. ($requierd[$x] == 1? 'id="optional"':'').'name="optional">
										</div>
										</div>';
					} //$Optional[$x] == 1 && $requierd[$x] == 1
				
				} // end for
			 ?>
 <input type="submit" value="التسجيل" name="register" class="btn btn-nor-primary btn-lg enable-overlay">
                  </form>
               </div>
            </div>
         </div>
      </div>
	<script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/appjs/Form.js"></script>
    <script src="js/appjs/common.js"></script>

    <script>
        $(function() {
            $("#includedContent").load("php/TopNav.php");
            $("#includedContent2").load("HTML/rightNav.html");
        });
    </script>
   </body>
</html>