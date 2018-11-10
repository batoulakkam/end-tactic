<?php
require_once 'php/connectTosql.php';
$organizerid = $_SESSION['organizerID'];

if (isset($_POST['update'])) {
 $prizeId = $_GET['prizeId'];
 $eventId    = $_POST["eventId"];
 $prizeName  = $_POST['prizeName'];
 $numOfPrize = $_POST['prizeNum'];
 $subeventId = $_POST['subEventId'] == '' ? null : $_POST['subEventId'];


 $sql = " UPDATE prize SET namePrize='$prizeName' ,numOfPrize ='$numOfPrize'
              ,event_ID='$eventId',subevent_ID='$subeventId',
              WHERE Prize_ID ='$prizeId'";
 $sql = mysqli_query($con, $sql) or die(mysqli_error($con));
 if ($sql) {
  header("location: /tactic/managePrize.php");
  exit;
 } else {
  echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  لم تتم عملية التعديل بنجاح يرجى التحقق
       </div> ";
 }
}
if (isset($_GET['prizeId'])) {
$prizeId = $_GET['prizeId'];

// to get the record of prize that already added from add page
$prizeQuery = mysqli_query($con, "SELECT * FROM prize WHERE prize_ID ='$prizeId' ") or die(mysqli_error($con));

 $row = mysqli_fetch_row($prizeQuery);
$namePrize  = $row[1];
$numOfPrize = $row[2];
$eventId    = $row[3];
$subEventId = $row[4];


 // to fill drop down list of events
 $eventQuery = mysqli_query($con, "SELECT * FROM event where organizer_ID=  '$organizerid'") or die(mysqli_error($con));

 // to get the subevent by selected event ID
 $subeventQuery = mysqli_query($con, "SELECT * FROM subevent WHERE event_ID ='$eventId' ") or die(mysqli_error($con));


 

}

?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <title>تعديل الجائزة </title>
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
        <div class="panel-heading">
          <h4 class="panelTitle"> تعديل الجائزة  </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivEditPrize" method="post">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                    <select class="form-control" id="eventName" name="eventId">
                     <option  value=" ">اختيار</option>
                  <?php

while ($row = mysqli_fetch_array($eventQuery)):
 echo '<option  value="' . $row['event_ID'] . '" ' . ($eventId == $row['event_ID'] ? ' selected="selected"' : '') . '>' . $row['name_Event'] . '</option>';
 ?>
		                  <?php endwhile;?>

                </select>
              </div>
            </div>

             <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label  class="control-label">   اسم الحدث الفرعي </label>
                <select class="form-control" id="subEventName" name="subEventId" >
                <option  value=" ">اختيار</option>
                 <?php

while ($row = mysqli_fetch_array($subeventQuery)):
 echo '<option  value="' . $row['subevent_ID'] . '" ' . ($subEventId == $row['subevent_ID'] ? ' selected="selected"' : '') . '>' . $row['nameSubEvent'] . '</option>';
 ?>
			                  <?php endwhile;?>
                </select>

              </div>
            </div>
             <div class="col-md-12">
                <div class="form-group form-group-lg">
                <label for="prizeName" class="control-label"> اسم الجائزة</label>
                <input type="text" class="form-control" id="prizeName"  name="prizeName" value="<?php echo $namePrize ?>" required>
              </div>
            </div>

               <div class="col-md-12">
              <div class="form-group form-group-lg">
                   <label for="prizeNum" class="control-label"> عدد الجوائز</label>
                 <input type="number" class="form-control" id="prizeNum"  name="prizeNum" value = "<?php echo $numOfPrize ?>" required>
                  </div>
                 </div>

           <a  href="/tactic/managePrize.php"  class="bodyform btn btn-nor-danger btn-sm">عودة</a>
            <input type="submit" value="تعديل" name="update" class="btn btn-nor-primary btn-lg enable-overlay">



        </form>

      </div>
    </div>
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
