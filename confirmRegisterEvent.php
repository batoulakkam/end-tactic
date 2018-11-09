<?php
require_once('php/connectTosql.php');
$eventName = "";
$location  = "";
$startDate = "";
$endDate   = "";
if (isset($_GET['attendeeId'])) {
    $attendeeID = $_GET['attendeeId'];
    $query      = mysqli_query($con, "SELECT eventId , form FROM attendee WHERE Id= '$attendeeID'");
    $row        = mysqli_fetch_array($query);
    $eventID    = $row[0];
    $token      = $row[1];
    $query2     = mysqli_query($con, "SELECT * FROM event WHERE event_ID = '$eventID'");
    while ($row = mysqli_fetch_array($query2)) {
        $eventName = $row[1];
        $location  = $row[5];
        $startDate = $row[3];
        $endDate   = $row[4];
    } //$row = mysqli_fetch_array($query2)
} //isset($_GET['attendeeID'])
$locationBadge = "UploadFile/".$eventID."/badge/".$attendeeID.".jpg";
echo $locationBadge;
?>
<!DOCTYPE html>
<html lang="ar">
   <head>
      <title>شكرا لتسجيلك</title>
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
                  <h4 class="panelTitle"> شكرا لتسجيلك في <?php echo $eventName; ?> </h4>
               </div>
               <div class="panel-body">
                  <div class="col-md-12">
                     <pre>
<h5>اسم الحدث : <mark><?php echo $eventName; ?></mark></h5>
<h5>موقع الحدث : <mark> <?php echo $location; ?></mark> </h5>
<h5>تاريخ بداية الحدث : <mark> <?php echo $startDate; ?></mark></h5>
<h5>تاريخ نهاية الحدث : <mark><?php echo $startDate; ?></mark></h5>
</pre>
                     <pre>
<h5>الباركود الخاص بك :</h5>

<a  ><img id="badgePrint" src="<?php echo $locationBadge;?>" /></a>
</pre>
                     <a href="#" class="btn btn-nor-primary btn-lg enable-overlay" id="print" onclick="printJS(<img src='image\logo.png' )">
                     <span class="glyphicon glyphicon-print"></span> طباعة 
                     </a>				
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end of  register inputs -->
      <script src="js/jquery.min.js"></script>
      <script src="js/jquery.validate.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/appjs/common.js"></script>
      <script src="js/print.min.js"></script>
   </body>
</html>