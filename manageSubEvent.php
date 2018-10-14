<?php
//conect to database
require_once 'php/connectTosql.php';

///delete sub event
 if (isset($_GET['isDeleteAction']) && $_GET['isDeleteAction'] != '') {
 if (isset($_GET['subEventId']) && $_GET['subEventId'] != '') {
  //retreive the hidden id in modal
  $subEventId = $_GET['subEventId'];
  $sql     = "delete from  subevent  WHERE  subevent_ID = '$subEventId'";
  $query   = mysqli_query($con, $sql) or die(mysqli_error($con));

  //succsess to retreive id

  if ($query) {
   $retVal = true;
   echo json_encode($retVal); //convert value to client side jQ
   exit;
  } else {
   $retVal = false;
   echo json_encode($retVal);
   exit;

  }

 }else  {
   echo " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            عملية حذف خاطئة الرجاء اختيار الحدث الفرعي  المراد حذفها
					</div> ";
 }
}
// Search for subevent and event name
 if (isset($_GET['searchValue']) && $_GET['searchValue'] != '') {
  $searchValue = $_GET['searchValue'];

  $query = mysqli_query($con, $sql = "SELECT se.nameSubEvent,e.name_Event,se.event_ID,se.subevent_ID,e.event_ID
  FROM event e INNER JOIN subevent se ON e.event_ID = se.event_ID
  where nameSubEvent like '%$searchValue%' or  e.name_Event like '%$searchValue%'"
  ) or die(mysqli_error($con));

 } // end Search
 // this query for present all sub event that related to organizer
 else {
   $query = mysqli_query($con, $sql = "SELECT se.nameSubEvent,e.name_Event,se.event_ID,se.subevent_ID,e.event_ID
	  FROM event e INNER JOIN subevent se ON e.event_ID = se.event_ID") or die(mysqli_error($con));
  }
 ?>

	<!DOCTYPE html>
	<html>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- lobrary of icon  fa fa- --->
	<title>إدارة الأحداث الفرعية</title>

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
	          <h4 class="panelTitle">إدارة الأحداث الفرعية</h4>
	        </div>
	        <div class="panel-body">

	          <form action="manageSubEvent.php" class="manageSubEventFrm" method="Get">

	            <div class="col-md-12">
	              <div class="form-group form-group-lg">
	                <label for="eventName" class="control-label"> بحث ب اسم الحدث أو الحدث الفرعي </label>
	                <input type="text" class="form-control" id="txtSubEventName" name="searchValue" placeholder="بحث ...">
	              </div>
	            </div>

	            <div class="col-md-12">
	              <div class="form-group form-group-lg">
	                 <input type="submit" value="بحث" name="update"  class="btn btn-nor-primary btn-sm">
	                 <a class="btn btn-nor-primary btn-sm" href="addSubEvent.php"> إضافة حدث فرعي</a>

	              </div>
	            </div>
	          </form>
	        </div>
	      </div>


	    <table class="table table-striped">
	      <tr>
	        <th>  اسم الحدث الفرعي</th>
	        <th> اسم الحدث </th>
	        <th> خيارات </th>
	      </tr>


	          <?php

 while ($row = mysqli_fetch_array($query)):

  echo "<tr>";
  echo "<td><a  href='subEventDetails.php?subeventid=" . $row['subevent_ID'] . "'>" . $row['nameSubEvent'] . "</a></td>";
  echo "<td>" . $row['name_Event'] . "</td>";
  echo "<td> <a id='aEditsubEvent' href='editSubEvent.php?subeventid=" . $row['subevent_ID'] . "'><span class='fa fa-edit' style='font-size:24px;'></span></a>
				     <a href='#' id='aDeletEvent' class='adelete' data-id=" . $row['subevent_ID'] . "><span  class=' fa fa-trash' style='font-size:24px;color:red;  '></span> </a></td>
				      </tr>";

  ?>
		         <?php endwhile;?>


	  </table>
	 </div>


	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">حذف حدث</h4>
	      </div>
	      <div class="modal-body">
	        <p>هل انت متأكد من حذف الحدث</p>
	        <input type="hidden" id="hdSubEventId">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
	        <button type="button" id="btnConfirmDelete" class="btn btn-primary">تأكيد الحذف</button>
	      </div>
	    </div>
	  </div>
	</div>



	<script src="js/jquery.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/appjs/subEvent.js"></script>
	    <script src="js/appjs/common.js"></script>

	    <script>
	      $(function () {
	        $("#includedContent").load("php/TopNav.php");
	        $("#includedContent2").load("HTML/rightNav.html");
	      });
	    </script>

	</body>

	</html>