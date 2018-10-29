<?php
//connect to database
require_once 'php/connectTosql.php';

 
if (isset($_GET['eventName']) && $_GET['eventName'] != '') {
 $eventName = $_GET['eventName'];
 $query = mysqli_query($con, "SELECT * FROM event  WHERE  name_Event like '%$eventName%' ") or die(mysqli_error($con));
} else {
if (isset($_SESSION['organizerID'])){
$orgID = $_SESSION['organizerID'];
 $query = mysqli_query($con, "SELECT * FROM event WHERE organizer_ID = '$orgID' AND eventLink != '' ") or die(mysqli_error($con));

}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- lobrary of icon  fa fa- --->
<title>ادارة ارسال بريد الكتروني</title>

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
          <h4 class="panelTitle">إدارة ارسال بريد الكتروني </h4>
        </div>
        <div class="panel-body">

          <form action="manageForm.php" class="manageFormFrm" method="Get">

             <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                <input type="text" class="form-control" id="txtEventName" name="eventName" placeholder="بحث باسم الحدث  ..." >
              </div>
            </div>
			<div class="col-md-12">
              <div class="form-group form-group-lg">
			<input type="submit"  class=" btn btn-nor-primary  "  name="update" value = "بحث" style="width:145px">
            </div>
			  </div>
          
          </form>
        </div>
      </div>


    <table class="table table-striped">
      <tr>
		  <th >اسم الحدث </th>
        <th colspan = "3">ارسال بريد الكتروني </th>
		  <th >عرض المسجلين </th>
       
      </tr>

      <?php

while ($row = mysqli_fetch_array($query)):

 echo "<tr>";
 echo "<td><a  href='eventDetails.php?eventid=" . $row['event_ID'] . "'>" . $row['name_Event'] . "</a></td>";
 echo "<td> <a href='sendEmail.php?all=true&event_ID=" .$row['event_ID'] . "  '>ارسال بريد للجميع  </a></td>";
        echo "<td> <a href='sendEmail.php?VIP=true&event_ID=" .$row['event_ID'] . "  '>ارسال بريد للاشخاص المهمين  </a></td>";
        echo "<td> <a href='sendEmail.php?normal=true&event_ID=" .$row['event_ID'] . "  '>ارسال بريد للاشخاص العاديين  </a></td>";


		$IDevent = $row['event_ID'];
echo "<td> <a href='registeredEvent.php?eID=$IDevent '><span class=' 	fa fa-eye	
' style='font-size:24px;color:green;  '></span> </a></td>
		      </tr>";

      
		
		
		

 ?>
<?php endwhile;?>


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