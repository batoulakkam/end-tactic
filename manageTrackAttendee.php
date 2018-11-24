<?php
	// connect to database

	require_once 'php/connectTosql.php';
if (isset($_SESSION['organizerID'])) {
  $orgID = $_SESSION['organizerID'];
$flag = true;
if (isset($_GET['eventName']) && $_GET['eventName'] != '') {
 $eventName = $_GET['eventName'];
 $query     = mysqli_query($con, "SELECT * FROM event  WHERE  name_Event like '%$eventName%' AND organizer_ID = '$orgID' ") or die(mysqli_error($con));
if (mysqli_num_rows($query) == 0)
$flag = false;} 
else {
 
  $query = mysqli_query($con, "SELECT * FROM event WHERE organizer_ID = '$orgID' AND eventLink != '' ") or die(mysqli_error($con));

 }
}
else{
    header('Location:LogIn.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- lobrary of icon  fa fa- --->
<title>إدارة تتبع الحضور </title>

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
          <h4 class="panelTitle">إدارة تتبع الحضور  </h4>
        </div>
        <div class="panel-body">

          <form action="manageForm.php" class="manageEventFrm" method="Get">

             <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
				
                <input type="text" class="form-control" id="txtEventName" name="eventName" placeholder="بحث باسم الحدث  ..." >

		
                  
                 </div>

              </div>
              <div class="col-md-12">
              <div class="form-group form-group-lg">
            <input type="submit" value="بحث" name="update" class="btn btn-nor-primary btn-sm">
            </div>
              </div>

          </form>
        </div>
      </div>


    <table class="table table-striped">
       <tr>
                    <th>اسم الحدث</th>
                    <th> تتبع الحضور </th>
                   
                </tr>

      <?php
  if($flag =="true"){
while ($row = mysqli_fetch_array($query)){
    $Id = $row['event_ID'];
      echo "<tr>";
								echo "<td><a  href='eventDetails.php?eventid=" . $row['event_ID'] . "' data-toggle='tooltip' data-placement='right' title='تفاصيل الحدث'>" . $row['name_Event'] . "</a></td>";
								
								echo "<td> <a href='trackAttendee.php?eID=$Id '><span class='     fa fa-eye ' style='font-size:24px;color:green; data-toggle='tooltip' data-placement='right' title='عرض المسجلين لهذا الحدث '  '></span> </a></td></tr>";}
  }
        else{if ($flag == false ){
            echo "<tr>";
		echo "<td colspan='6'> <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' name ='update' data-dismiss='alert'>&times;</button>
         لم يتم العثور على نتيجة.
         <a href='manageForm.php' ><br> <div  class='glyphicon glyphicon-refresh' style='font-size:24px  '></div></a>  
       </div> 
            
        
         </td>";
            
            echo "</tr>";}}

 ?>


    </table>
 </div>
   


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/Form.js"></script>
  <script src="js/appjs/common.js"></script>


  <script>
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>