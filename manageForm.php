<?php
	// connect to database

	require_once 'php/connectTosql.php';
if (isset($_SESSION['organizerID'])) {
  $orgID = $_SESSION['organizerID'];
$flag = true;
if (isset($_GET['isDeleteAction']) && $_GET['isDeleteAction'] != '')
		{
		if (isset($_GET['eventId']) && $_GET['eventId'] != '')
			{ //retreive the hidden id in modal
			$eventId = $_GET['eventId'];
			$sql = "Update event SET eventLink ='' WHERE  event_ID = '$eventId'";
			$query = mysqli_query($con, $sql) or die(mysqli_error($con));
			mysqli_query($con, "delete from  registration_form  WHERE  event_ID = '$eventId'");
			mysqli_query($con, "delete from  attendee WHERE  event_ID = '$eventId'");
			// succsess to retreive id
            
 if ($query) {
  $retVal = true;
  echo json_encode($retVal); //convert value to client side jQ

  exit;
 } else {
  $retVal = false;
  echo json_encode($retVal);
     $flag = false;
  exit;

 }

}
    }
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
<title>إدارة نموذج التسجيل</title>

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
          <h4 class="panelTitle">إدارة نموذج التسجيل </h4>
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
			 <a class="btn btn-nor-primary btn-sm" href="createForm.php"> إضافة نموذج </a>
            </div>
              </div>

          </form>
        </div>
      </div>


    <table class="table table-striped">
       <tr>
                    <th>اسم الحدث</th>
                    <th> رابط الحدث </th>
                    <th> كود الاشخاص المهمين </th>
                    <th colspan="2"> خيارات </th>
                    <th> عرض المسجلين </th>
                </tr>

      <?php
  if($flag =="true"){
while ($row = mysqli_fetch_array($query)){
    $Id = $row['event_ID'];
    $badgeID = "";
    $sqBadge     = mysqli_query($con, "SELECT badge_ID FROM badge  WHERE  event_ID = '$Id' ") or die(mysqli_error($con));
    $rows = mysqli_fetch_array($sqBadge);
    $badgeID = $rows['badge_ID'];

                                echo "<tr>";
								echo "<td><a  href='eventDetails.php?eventid=" . $row['event_ID'] . "' data-toggle='tooltip' data-placement='right' title='تفاصيل الحدث'>" . $row['name_Event'] . "</a></td>";
								$query2 = mysqli_query($con, "SELECT token FROM registration_form WHERE event_ID=" . $row['event_ID']) or die(mysqli_error($con));
								$row2  = mysqli_fetch_array($query2);
								$token = $row2['token'];
    if($badgeID!="")
								echo "<td><a href='Form.php?token=$token'>" . $row['eventLink'] . "</a></td>";
    else
        echo "<td><a href='addBadge.php'   data-toggle='tooltip' data-placement='right' title='اضافة بطاقة تعريفية للحدث' >
        قم بأضافة بطاقة تعريفية لتتمكن من استعرض رابط الحدث </a></td>";
    
    
								$query3 = mysqli_query($con, "SELECT VIPCode FROM event WHERE event_ID=" . $row['event_ID']) or die(mysqli_error($con));
								$row3 = mysqli_fetch_array($query3);
								echo "<td>" . $row3['VIPCode'] . "</td>";
								echo "<td> <a id='aEditEvent' href='editForm.php?token=$token'><span class='fa fa-edit' style='font-size:24px;' data-toggle='tooltip' data-placement='right' title='تعديل نموذج الحدث'></span></a></td>";
								echo "<td> <a href='#' id='aDeletEvent' class='adelete' data-id=" . $row['event_ID'] . "><span  class=' fa fa-trash' style='font-size:24px;color:red;  ' data-toggle='tooltip' data-placement='right' title='حذف الحدث'></span> </a></td>";
								$IDevent = $row['event_ID'];
								echo "<td> <a href='registeredEvent.php?eID=$IDevent '><span class='     fa fa-eye ' style='font-size:24px;color:green; data-toggle='tooltip' data-placement='right' title='عرض المسجلين لهذا الحدث '  '></span> </a></td></tr>";}
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
   <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">حذف نموذج </h4>
                    </div>
                    <div class="modal-body">
                        <p>هل انت متأكد من حذف النموذج </p>
                        <input type="hidden" id="hdEventId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <button type="button" id="btnConfirmDelete" class="btn btn-primary">تأكيد الحذف</button>
                    </div>
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
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>