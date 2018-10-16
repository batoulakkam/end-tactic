<?php
//connect to database
require_once 'php/connectTosql.php';
if (isset($_GET['eventName']) && $_GET['eventName'] != '') {
$eventName = $_GET['eventName'];
 $query = mysqli_query($con, "SELECT * FROM event  WHERE  name_Event like '%$eventName%' ") or die(mysqli_error($con));
} else {
if (isset($_SESSION['organizerID'])){
$orgID = $_SESSION['organizerID'];
$current= date('Y-m-d');
$query = mysqli_query($con, "SELECT * FROM event WHERE organizer_ID = '$orgID' AND sartDate_Event = ' $current'  ") or die(mysqli_error($con));

}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- lobrary of icon  fa fa- --->
<title>إدارة التسجيل الفوري </title>

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
          <h4 class="panelTitle">إدارة التسجيل الفوري  </h4>
        </div>
        <div class="panel-body">

          <form action="manageEvent.php" class="manageEventFrm" method="Get">

            <div class="col-md-12">
              <div class="form-group form-group ">
                <label for="eventName" class="control-label"> اسم الحدث</label>
				 <div class="form-inline">
                <input type="text" class=" form-control" id="txtEventName" name="eventName" required style="width: 450px">
					 
					 <input type="submit"  class=" btn btn-nor-primary  "  name="update" value = "بحث" style="width:145px"> 
			</div>
				
              </div>
			 
            </div>

          
          </form>
        </div>
      </div>


    <table class="table table-striped">
      <tr>
        <th>اسم الحدث</th>
        <th> التسجيل الفوري </th>
      </tr>

      <?php
echo date('Y-m-d');
while ($row = mysqli_fetch_array($query)):

 echo "<tr>";
 echo "<td><a  href='eventDetails.php?eventid=" . $row['event_ID'] . "'>" . $row['name_Event'] . "</a></td>";
	echo "<td> <a href='onsiteRegister.php?eID=".$row['event_ID']." '><span class='fa fa-edit	
' style='font-size:24px;color:blue;  '></span> </a></td>
		      </tr>";

 echo"</tr>";

      
		
		
		

 ?>
<?php endwhile;?>


    </table>
 </div>

</div>

  <script src="js/jquery.min.js"></script>
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