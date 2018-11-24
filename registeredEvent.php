<?php
require_once('php/connectTosql.php');
$flag ="true";
if(isset($_GET['eID'])){
$eID = $_GET['eID'];
$mainQuery = mysqli_query($con,"SELECT  name_Event FROM event WHERE event_ID = '$eID'");
$row =mysqli_fetch_array($mainQuery);
$eventName = $row['name_Event'];
$mainQuery = mysqli_query($con,"SELECT * FROM attendee WHERE eventId = '$eID'") or die(mysqli_error($con)); 
if (isset($_GET['attendeeInfo']) && $_GET['attendeeInfo'] != '' ) {
 $attendee = $_GET['attendeeInfo'];
 $mainQuery = mysqli_query($con, "SELECT * FROM attendee WHERE  eventId = '$eID' AND email like '$attendee%' OR phone like '%$attendee%'  ") or die(mysqli_error($con));
if (mysqli_num_rows($mainQuery) == 0)
$flag = false;
}
else {
    
 $mainQuery = mysqli_query($con, "SELECT * FROM attendee WHERE eventId = '$eID'") or die(mysqli_error($con));
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- lobrary of icon  fa fa- --->
<title> المسجلين  </title>

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
          <h4 class="panelTitle"> المسجلين في : <?php echo $eventName; ?>  </h4>
        </div>
        <div class="panel-body">
		   <form action="registeredEvent.php"  method="Get">
   <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> البحث بالبريد الالكتروني او رقم الهاتف</label>
				
                <input type="text" class="form-control" id="txtEventName" name="attendeeInfo" placeholder="بحث   ..." >
                  <input type="text"   name="eID" value = "<?php echo $eID; ?>" style="display:none">

		
                  
                 </div>

              </div>
              <div class="col-md-12">
              <div class="form-group form-group-lg">
            <input type="submit"  class=" btn btn-nor-primary  "  name="update" value = "بحث" >
            </div>
              </div>

          
          </form>
        </div>
      </div>


    <table class="table table-striped">
      <tr>
		 <th>  </th>
        <th>اسم المسجل</th>
        <th>البريد الالكتروني    </th>
        <th>الهاتف  </th>
		 <th>ارسال بريد  </th>
		</tr>
		<?php
        if($flag =="true"){
            
		$x=1;
		while ($rows = mysqli_fetch_array($mainQuery)){
		echo "<tr>";
		echo "<td> $x </td>";
		echo "<td>"; echo $rows['name']; echo " </td>";
		echo "<td>"; echo $rows[1]; echo " </td>";
		echo "<td>"; echo $rows[3]; echo " </td>";
		echo "<td> <a href='EmailAttendee.php?AttendeeID=".$rows['Id']." '><span class='fa fa-envelope-o	
		' style='font-size:24px;color:blue;  '></span> </a></td>";
		echo "</tr>";
		
		$x++;
		}}
        else{if ($flag == false ){
            echo "<tr>";
					echo "<td colspan='6'> <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' name ='update' data-dismiss='alert'>&times;</button>
         لم يتم العثور على نتيجة.
         <a href='registeredEvent.php?eID=$eID'' ><br> <div  class='fas fa-undo'></i> </div></a>  
       </div> 
            
        
         </td>";
            echo "</tr>";}}?>
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