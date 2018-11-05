<?php
//conect to database
require_once 'php/connectTosql.php';
$organizerID = $_SESSION['organizerID'];

// to get the event by logged orgnizer
$eventQuery = mysqli_query($con, "select * from event where organizer_ID =$organizerID") or die(mysqli_error());
if (!empty($_GET)) {

 $eventId                    = $_GET['eventId'];
 $subEventId                 = $_GET['subEventId'];
 $statisticsClassificationId = $_GET['statisticsClassificationId'];
 if ($subEventId == -1) {
  switch ($statisticsClassificationId) {
   case "1":
    $query = "SELECT count(id),name_Event as Name FROM event ev inner join attendee att
on ev.event_ID=att.eventId
where ev.organizer_ID=$organizerID
and (att.eventId=$eventId or $eventId=-1)
GROUP BY event_ID";
    break;
   case "2":
    $query = "SELECT count(att.id),ge.Name as Name FROM gender ge inner join
   attendee att on ge.Id=att.genderId
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  )
   ) GROUP BY ge.Id";
    break;
   case "3":
    $query = "SELECT count(att.id),na.Name as Name FROM nationality na inner join
    attendee att on na.Id=att.nationalityId
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  )
      ) GROUP BY na.Id";
    break;
   case "4":
    $query = "SELECT count(att.id),ed.Name as Name FROM educationallevel ed inner join attendee att on ed.Id=att.educationalLevelId
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  )) GROUP BY ed.Id";
    break;
   case "5":
    $query = "SELECT count(id),floor(datediff(curdate(),DOB) / 365) as Name FROM  attendee att
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  ))
       and floor(datediff(curdate(),DOB) / 365) is NOT null
    GROUP BY floor(datediff(curdate(),DOB) / 365)";
    break;
   case "6":
    $query = "SELECT count(id),jobTitle as Name FROM attendee att
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  ))
   GROUP BY att.jobTitle";
    break;
   case "7":
    $query = "SELECT count(id),(CASE when checkInEventAttende=1 THEN 'تم الحضور' ELSE 'لم يتم الحضور' END)  as Name FROM attendee att
   where ((att.eventId=$eventId) or (att.eventId in(
       select eventId from event where organizer_ID  =$organizerID) and $eventId=-1  ))
   GROUP BY att.checkInEventAttende";
    break;
  }
 } //end if subEventId=-1
 else {
   switch ($statisticsClassificationId) {
    case "2":
     $query = "SELECT count(att.id),ge.Name as Name FROM gender ge inner join
	   attendee att on ge.Id=att.genderId
	   where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	    GROUP BY ge.Id";
	 break;
	 
	 case "3":
    $query = "SELECT count(att.id),na.Name as Name FROM nationality na inner join
    attendee att on na.Id=att.nationalityId
     where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	    GROUP BY na.Id";
    break;
   case "4":
    $query = "SELECT count(att.id),ed.Name as Name FROM educationallevel ed inner join attendee att on ed.Id=att.educationalLevelId
   where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	     GROUP BY ed.Id";
	break;
	case "5":
    $query = "SELECT count(id),floor(datediff(curdate(),DOB) / 365) as Name FROM  attendee att
    where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	     and floor(datediff(curdate(),DOB) / 365) is NOT null
    GROUP BY floor(datediff(curdate(),DOB) / 365)";
	break;
	case "6":
    $query = "SELECT count(id),jobTitle as Name FROM attendee att
   where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	     GROUP BY att.jobTitle";
	break;
	case "7":
    $query = "SELECT count(id),(CASE when checkInEventAttende=1 THEN 'تم الحضور' ELSE 'لم يتم الحضور' END)  as Name FROM attendee att
    where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	     GROUP BY att.checkInEventAttende";
    break;
   }
  } //end else
 if(isset($query))
 {
  $statisticQuery = mysqli_query($con, $query) or die(mysqli_error());

  $statisticArray = array();
  while ($row = mysqli_fetch_array($statisticQuery)) {

   $statisticArray[] = array("x_val" => $row['Name'], "y_val" => $row[0]);

  }
  echo json_encode($statisticArray);

}

  exit;

  $mainQuery = mysqli_query($con, $sql) or die(mysqli_error($con));
 } else {
  $eventId  = -1;
  $subEventId = -1;
  $statisticsClassificationId = 1;
 }

 ?>


	<!DOCTYPE html>
	<html>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>الإحصائيات</title>

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
	                    <h4 class="panelTitle">الإحصائيات</h4>
	                </div>
	                <div class="panel-body">

	                    <form action="statistics.php" class="statisticsFrm" method="Get">

	                        <div class="col-md-16 printhide">
	                            <div class="col-md-12">
	                                <div class="form-group form-group-lg">
	                                    <label class="control-label">تصنيف الإحصائيات</label>
	                                    <select class="form-control" id="statisticsClassificationId" name="statisticsClassificationId">

	                                        <option value="1" <?php if ($statisticsClassificationId == "1") {
  echo
   ' selected="selected"';}?> > حسب الحدث</option>
	                                        <option value="2" <?php if ($statisticsClassificationId == "2") {
  echo
   ' selected="selected"';}?> >حسب الجنس</option>
	                                        <option value="3" <?php if ($statisticsClassificationId == "3") {
  echo
   ' selected="selected"';}?> >حسب الجنسية</option>
	                                        <option value="4" <?php if ($statisticsClassificationId == "4") {
  echo
   ' selected="selected"';}?> >حسب مستوى التعليم</option>
	                                        <option value="5" <?php if ($statisticsClassificationId == "5") {
  echo
   ' selected="selected"';}?> >حسب العمر</option>
	                                        <option value="6" <?php if ($statisticsClassificationId == "6") {
  echo
   ' selected="selected"';}?> >حسب المهنة</option>
	                                        <option value="7" <?php if ($statisticsClassificationId == "7") {
  echo
   ' selected="selected"';}?> >حسب حالة الحضور</option>
	                                    </select>
	                                </div>
	                            </div>



	                            <div class="col-md-12">
	                                <div class="form-group form-group-lg">
	                                    <label for="eventName" class="control-label"> اسم الحدث</label>
	                                    <select class="form-control" id="eventName" name="eventId">
	                                        <?php
 echo '<option  value="-1" ' . ($eventId === -1 ? ' selected="selected"' : '') . '>الكل</option>';
 while ($row = mysqli_fetch_array($eventQuery)):
  echo "<option value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>";
  ?>
		                                        <?php endwhile;?>

	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-md-12">
	                                <div class="form-group form-group-lg">
	                                    <label for="subEventName" class="control-label"> اسم الحدث الفرعي</label>
	                                    <select class="form-control" id="subEventName" name="subEventId">
	                                        <option value="-1"> اختيار </option>
	                                    </select>
	                                </div>
	                            </div>


	                            <div class="col-md-12">
	                                <div class="form-group form-group-lg">
	                                    <input type="button" value="طباعة الإحصائيات" Id="btnPrintStatistics" class=" btn btn-nor-primary btn-sm">

	                                    <input type="submit" value="مشاهدة الإحصائيات" name="btnDisplayStatistics" class=" btnDisplayStatistics btn btn-nor-primary btn-sm">

	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div id="divstatistics" class="chartdiv" style="display:none"></div>
	                        </div>
	                    </form>
	                </div>
	            </div>

	        </div>



	        <script src="js/jquery.min.js"></script>
	        <script src="js/bootstrap.min.js"></script>
	        <script src="js/appjs/common.js"></script>
	        <script src="js/amcharts/amcharts.js"></script>
	        <script src="js/amcharts/serial.js"></script>
	        <script src="js/amcharts/ammap.js"></script>
	        <script src="js/amcharts/saudiArabiaLow.js"></script>
	        <script src="js/amcharts/pie.js"></script>
	        <script src="js/amcharts/themes/light.js"></script>
	        <script src="js/appjs/app.dashboard.js"></script>
	        <script src="js/appjs/statistics.js"></script>

	        <script>
	            $(function () {
	                $("#includedContent").load("php/TopNav.php");
	                $("#includedContent2").load("HTML/rightNav.html");
	            });
	        </script>

	</body>

	</html>