<?php
require_once('php/connectTosql.php');
 $EditeventID='';
if(isset($_GET['token'])){
    $selected[] ="";
    $requierd[] ="";
    $length =0;
   $tokenEdit = $_GET['token'];
	// كويري لجييب الايدي تبع لايفنت اللي ئلهم نفس التوكن
   $query = mysqli_query($con,"SELECT name_of_field , event_ID  FROM registration_form WHERE token = '$tokenEdit'");
	$row =mysqli_fetch_array($query);
	$EditeventID = $row['event_ID'];
	
	// كويري لجيب اسم الايفنت اللي بدو نعدلو الفورم
	$query2 = mysqli_query($con,"SELECT name_Event FROM event WHERE event_ID = '$EditeventID'");
	$row2 =mysqli_fetch_array($query2);
	$EditeventName = $row2['name_Event'];
	// حذفت كلشي قديم مختارو للفورم مشان اعمل جديد 
	$sql =  mysqli_query($con,"select *  FROM registration_form WHERE event_ID = '$EditeventID'");
    $x =0;
	while($row =mysqli_fetch_array($sql)){
    $selected[$x] = $row['name_of_field'];
    $x++;
          
    }
    $length    = count($selected);

// 


  if (isset($_POST['create'])){
      $sql =  mysqli_query($con,"Delete FROM registration_form WHERE event_ID = '$EditeventID'");
	 $EditID= $_SESSION['EditeventID'];
	$requierdField =0;
	$selectedField = 0;
// Name

	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES  ('','الاسم',1,1,'$EditID')")or die(mysqli_error($con));


// email

	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الايميل',1,1,'$EditID')")or die(mysqli_error($con));

// phone
	if(isset($_POST['choicedPhone'])){
	$selectedField = $_POST['choicedPhone'];
	if( isset($_POST['requierdPhone']) )
	$requierdField = $_POST['requierdPhone'];
	$length = $_POST['LengthPhone'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الهاتف','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}
	 
// age
		 
	if(isset($_POST['choicedAge'])){
	$selectedField = $_POST['choicedAge'];
	if( isset($_POST['requierdAge']) )
	$requierdField = $_POST['requierdAge'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','العمر','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}
	 
// gender
		 
	if(isset($_POST['choicedGender'])){
	$selectedField = $_POST['choicedGender'];
	if( isset($_POST['requierdGender']) )
	$requierdField = $_POST['requierdGender'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الجنس','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}	
// edu
		 
	if(isset($_POST['choicedEdu'])){
	$selectedField = $_POST['choicedEdu'];
	if( isset($_POST['requierdEdu']) )
	$requierdField = $_POST['requierdEdu'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','التعليم','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}
	
// job
		 
	if(isset($_POST['choicedJob'])){
	$selectedField = $_POST['choicedJob'];
	if( isset($_POST['requierdJob']) )
	$requierdField = $_POST['requierdJob'];
	$length = $_POST['lengthJob'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','المهنة','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}	 
	 
// Nationality
		 
	if(isset($_POST['choicedNationality'])){
	$selectedField = $_POST['choicedNationality'];
	if( isset($_POST['requierdNationality']) )
	$requierdField = $_POST['requierdNationality'];
	//$length = $_POST['lengthNationality'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الجنسية','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}	
	
// ID
		 
	if(isset($_POST['choicedID'])){
	$selectedField = $_POST['choicedID'];
	if( isset($_POST['requierdID']) )
	$requierdField = $_POST['requierdID'];
	$length = $_POST['lengthID'];
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الهوية','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}
	 
// ID
	 $VIP=0000;
		 
	if(isset($_POST['choicedVIP'])){
	$selectedField = $_POST['choicedVIP'];
	if( isset($_POST['requierdVIP']) )
	$requierdField = $_POST['requierdVIP'];
	$length = $_POST['lengthVIP'];
////////////////////////////////////////////////	
		$VIP = '1234567890';
      $VIP= str_shuffle($VIP);
      $VIP= substr($VIP,0,4);
	
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,event_ID) VALUES ('','الاشخاص المهمة','$selectedField','$requierdField','$EditID')")or die(mysqli_error($con));
}
		if(isset($_POST['optional'])){
	$nameField =$_POST['optional'];
	$length = $_POST['lengthID'];
	if( $nameField !='')
	$sql = mysqli_query($con, "INSERT INTO registration_form (form_ID, name_of_field, selected_field,required_field,optional,event_ID) VALUES ('','$nameField','$selectedField','$requierdField',1,'$EditID')")or die(mysqli_error($con));
}
 $token = 'abcdefghijkqwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
      $token= str_shuffle($token);
      $token= substr($token,0,10);
	$link= "http://localhost/tactic/Form.php?token=".$token;
	$sql = mysqli_query($con, "	UPDATE event SET 
    eventLink = '$link' , VIPCode = '$VIP' WHERE event_ID = '$EditID'")or die(mysqli_error($con));
	$sql2 = mysqli_query($con, "UPDATE registration_form SET 
    token='$token' WHERE event_ID = '$EditID'")or die(mysqli_error($con)); 
	header('Location:manageForm.php');
	  unset($_SESSION['EditeventID']);
	 }
}
$_SESSION['EditeventID']= $EditeventID;
	 
	 
	 ?> 			  
			
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- lobrary of icon  fa fa- --->
<title>تعديل نموذج التسجيل </title>

<link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css' />
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
  <div id="includedContent"></div>
  <div id="includedContent2"></div>
  <div class="mainContent">

    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle"> تعديل نموذج التسجيل <?php echo $EditeventName; ?></h4>
        </div>
        <div class="panel-body">
		<form action="" class="formDiv" method="post">
		<table class="table table-striped">
		<thead>
		    <tr > 

				 <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
        <select id="Event" name="eventID" class="form-control" disabled >
      <option value='<?php echo $EditeventID ; ?>'> <?php echo $EditeventName; ?></option>
	    
     </select> 
			 </div></div> 
              
                </tr>
           <tr height="50" >
        
		 <th class="text-align" >اسم الحقل </th>
		<th class="text-align" >اختيار </th>
		 <th class="text-align">الحقل اجباري </th>
	
    </thead>
    <tbody class="text-align">
      <tr>
		 <td>الاسم </td>
		 <td><div><input type="checkbox" name ="requiredName" value="1" class="form-control" disabled checked > </div></td>
		 <td><div><input type="checkbox" name="choicedName" value="1" class="form-control"  disabled checked></div></td>
       
        
        
        

      </tr>
      <tr>
		 <td>البريد الالكتروني  </td>
		  <td><div><input type="checkbox" name="choicedEmail" value="1" class="form-control" disabled checked ></div></td>
		  <td><div><input type="checkbox" name="requierdEmail" value="1" class="form-control" disabled checked > </div></td>
    
      </tr>
      <tr>
          
		 <td>رقم الهاتف</td>
        
   		<td><div><input type="checkbox" name="choicedPhone" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'الهاتف' ) echo "checked"; ?> ></div></td>
        <td><div><input type="checkbox" name ="requierdPhone" value="1" class="form-control"> </div></td>
		
      </tr>
      <tr>
		 <td>العمر </td>
        
        <td><div><input type="checkbox" name="choicedAge" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'العمر' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdAge" value="1" class="form-control"> </div></td>
    
      </tr>
      <tr>
		<td>الجنس </td>
        
        <td><div><input type="checkbox" name="choicedGender" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'الجنس' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdGender" value="1" class="form-control"> </div></td>
    
      </tr>
		<tr>
		<td>مستوى التعليم</td>
        <td><div><input type="checkbox" name="choicedEdu" value="1" class="form-control"  <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'التعليم' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdEdu" value="1"class="form-control"> </div></td>

      </tr>

      <tr>
		 <td>المهنة </td>
      	<td><div><input type="checkbox" name="choicedJob" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'المهنة' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdJob" value="1" class="form-control"> </div></td>
        
      </tr>
      <tr>
		 <td>الجنسية </td>
        <td><div><input type="checkbox" name="choicedNationality" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'الجنسية' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdNationality" value="1" class="form-control"> </div></td>

      </tr>
      <tr>
        <td>رقم الهوية</td>
        <td><div><input type="checkbox" name="choicedID" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'الهوية' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdID" value="1" class="form-control"> </div></td>
      </tr>
      <tr>
        <td>كود للاشخاص المهمين  </td>
        <td><div><input type="checkbox" name="choicedVIP" value="1" class="form-control" <?php  for ($x = 0; $x < $length; $x++)  if($selected[$x]== 'الاشخاص المهمة' ) echo "checked"; ?>></div></td>
        <td><div><input type="checkbox" name ="requierdVIP" value="1" class="form-control"> </div></td>
      </tr>
	   <tr>
        <td colspan="4" class="success" ><a  onclick="toggleMenu2()"><span class="fa fa-plus-circle " style="color:green " >  أضاقة حقل  </span></a></td>
      </tr>
		<tr  id="box" style="display:none">
       <td  ><label  class="control-label"> اسم الحقل </label><input type="text" name="optional"  class="form-control"></td>
       <td ><label class="control-label"> اختيار </label><input type="checkbox" name="choicedoptional" value="1" class="form-control" ></td>
        <td ><label  class="control-label"> الحقل اجباري</label><input type="checkbox" name ="requierdoptional" value="1" class="form-control"  ></td>
		
       
      </tr>
    </tbody>
 		  
  
			</table>
			 <a href="manageForm.php" class="bodyform btn btn-nor-danger btn-sm">عودة</a>
  <input type="submit" value="تعديل" name="create" class="btn btn-nor-primary btn-lg enable-overlay">
   
		
  
			</form>
   </div>
    </div>
  </div>
</div>

 <script src="js/jquery.min.js"></script>
<script src="js/javaScriptfile.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/event.js"></script>
  <script src="js/appjs/common.js"></script>
  

  <script>
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>