<?php
require_once 'php/connectTosql.php';
$organizerid = $_SESSION['organizerID'];

if (isset($_POST['save'])) {
 $prizeId = $_GET['prizeId'];
// in case the user try to save more the one time we will delete old values and add the new winners
 $query = "DELETE from attendeewinners where prizeId=$prizeId";
 $sql   = mysqli_query($con, $query) or die(mysqli_error($con));

 // to get the record of prize that already added from add page
 $prizeQuery         = mysqli_query($con, "SELECT * FROM prize WHERE prize_ID ='$prizeId' ") or die(mysqli_error($con));
 $row                = mysqli_fetch_row($prizeQuery);
 $numOfPrize         = $row[2];
 $isSuccessOperation = true;
 for ($countPrize = 0; $countPrize < $numOfPrize; $countPrize++) {

  $attendeeId = $_POST['attendeeId' . $countPrize];

  $query = "INSERT INTO attendeewinners (attendeeId, prizeId)
        VALUES ($attendeeId,$prizeId)";

  $sql = mysqli_query($con, $query) or die(mysqli_error($con));
  if (!$sql) {
   $isSuccessOperation = false;
   break;
  }
 }
 if ($isSuccessOperation) {
  header("location: /tactic/managePrize.php");
  exit;
 } else {

  // in case we have any problem with saving winners we will delete all winner related with this
  //prize to start another clean operation

  $query = "DELETE from attendeewinners where prizeId=$prizeId";

  $sql = mysqli_query($con, $query) or die(mysqli_error($con));
  echo "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
           لم تتم عملية حفظ الفائزين بنجاح يرجى الإعادة
       </div> ";
 }
}

if (isset($_GET['prizeId'])) {
 $prizeId = $_GET['prizeId'];

// to get the record of prize that already added from add page


 $prizeQuery = mysqli_query($con, "SELECT * FROM prize WHERE prize_ID ='$prizeId' ") or die(mysqli_error($con));
 $row        = mysqli_fetch_row($prizeQuery);
 $namePrize  = $row[1];
 $numOfPrize = $row[2];
 $eventId    = $row[3];
 $subEventId = $row[4];


 // to load the winners that already selected in case we have them
 if (!isset($_POST['chooseWinner'])) {
  // to get the record of prize that already added from add page
  $query = "Select att.id ,  att.name,phone,email,na.Name as
nationalityName ,DOB from attendeewinners atw inner join attendee att on att.id=atw.attendeeId
inner join nationality na on na.Id=att.nationalityId where atw.prizeId =$prizeId";
  $winnerQuery = mysqli_query($con, $query) or die(mysqli_error($con));
 }
}

?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <title>اختيار الفائزين </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' type='text/css' />
  <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' type='text/css' />
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
        <div class="panel-heading printhide">
          <h4 class="panelTitle"> اختيار الفائزين </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivEditPrize" method="post">

<div class="col-md-16 printhide">
            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="prizeName" class="control-label"> اسم الجائزة</label>
                <label type="text" class="form-control" id="prizeName" name="prizeName">
                  <?php echo $namePrize ?>
                </label>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="prizeNum" class="control-label"> عدد الجوائز</label>
                <label class="form-control" id="prizeNum" name="prizeNum">
                  <?php echo $numOfPrize ?>
                </label>
              </div>
            </div>
            <a href="/tactic/managePrize.php" class="bodyform btn btn-nor-danger btn-sm">عودة</a>
            <input type="submit" value="حفظ" name="save" class="btn btn-nor-primary btn-lg enable-overlay">
            <input type="button" value="طباعة أسماء الفائزين" Id="btnPrintWinners" class=" btn btn-nor-primary btn-sm">
            <input type="submit" value="اختيار الفائزين" name="chooseWinner" class="btn btn-nor-primary btn-lg enable-overlay">

        </div>
      </div>
      </div>

      <table class="table table-striped">
        <tr>
          <th> الاسم </th>
          <th> الهاتف </th>
          <th> البريد الإلكتروني </th>
          <th> الجنسية </th>
          <!-- <th> تاريخ الميلاد </th> -->

        </tr>
        <?php

// get all attende that attend the event related with Prize
$result = array();

if (isset($_POST['chooseWinner'])) {
 if ($eventId != null) {
   if($subEventId == 0)
   {
     // in case we want winners for main event
  $sql = "SELECT att.id ,  att.name,phone,email,na.Name as nationalityName ,DOB FROM `attendee` att INNER JOIN nationality na
                   on att.nationalityId=na.Id where att.eventid=$eventId and att.checkInEventAttende=1";
   }
   else{
     // in case we want winners for subevent
     $sql = "SELECT att.id ,  att.name,phone,email,na.Name as nationalityName ,DOB  FROM attendee att
      INNER JOIN nationality na on att.nationalityId=na.Id 
   where (att.id in
	   (select att.id from subeventattendee where subeventId='$subEventId' and checkInSubeventAttende=1) )
	    ";

   }
  $attendeQuery = mysqli_query($con, $sql) or die(mysqli_error($con));

  $dataArray = array();
  while ($res = mysqli_fetch_array($attendeQuery)) {
   $dataArray[] = array("attendeeId" => $res['id'], "attendeeName" => $res['name']
    , "attendeephone" => $res['phone'], "attendeeEmail" => $res['email']
    , "attendeeNationalityName" => $res['nationalityName'], "attendeeDOB" => $res['DOB'],
   );
  }
  $result = array_rand($dataArray, $numOfPrize);

 }
} else {
  // incase already has winner we need to show them to the user
 if (isset($winnerQuery)) {
  while ($res = mysqli_fetch_array($winnerQuery)) {
   $result[] = array("attendeeId" => $res['id'], "attendeeName" => $res['name']
    , "attendeephone" => $res['phone'], "attendeeEmail" => $res['email']
    , "attendeeNationalityName" => $res['nationalityName'], "attendeeDOB" => $res['DOB'],
   );
  }
 }
}

$count = 0;
foreach ($result as $key) {

  // in cae user select "ـختيار الفائزين" key is index or in case we get the user already selected from database key will be object
 $item = isset($winnerQuery) == false ? $dataArray[$key] : $key;

 echo '<input type="hidden" name="attendeeId' . $count . '" value="' . $item['attendeeId'] . '">';

 echo "<tr>";
 echo "<td><span >" . $item['attendeeName'] . "</span></td>";
 echo "<td><span >" . $item['attendeephone'] . "</span></td>";
 echo "<td><span >" . $item['attendeeEmail'] . "</span></td>";
 echo "<td><span >" . $item['attendeeNationalityName'] . "</span></td>";
 //  echo "<td><span >" . $item['attendeeDOB'] . "</span></td>";
 echo "</tr>";
 $count++;
}

?>
      </table>
      </form>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/prize.js"></script>
  <script src="js/appjs/common.js"></script>
  <script>
    // this part for call navBar
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>
</body>

</html>