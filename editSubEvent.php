<?php
require_once 'php/connectTosql.php';

// this section for get the event name fro DB
$query = mysqli_query($con, "SELECT * FROM event") or die(mysqli_error());

if (isset($_POST['update'])) {
 ///// chech the spelling of $subID
 $subEventID          = $_GET['subeventid'];
 $eventID             = $_POST["eventName"];//
 $subeEventName       = $_POST['subEventName'];
 $subEventDescription = $_POST["description"];
 $sql                 = mysqli_query($con, " UPDATE subevent SET event_ID='$eventID' ,nameSubEvent ='$subeEventName' , description_subevent = '$subEventDescription' WHERE subevent_ID ='$subEventID'") or die(mysqli_error($con));
 if ($sql) {
  header("location: /tactic/manageSubEvent.php");
 } else {
  echo " <div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong> فشل</strong>   عملية التعديل  يرجى التحقق
              </div> ";
 }
} //end if (isset($_POST['update']) )

$querysub = null;
if (isset($_GET['subeventid']) && $_GET['subeventid'] != '') {
 $subEventID = $_GET['subeventid'];
 $querysub   = mysqli_query($con, "SELECT * FROM subevent  WHERE subevent_ID ='$subEventID' ") or die(mysqli_error($con));
 if ($querysub == null) {
  // echo " <div class='alert alert-danger alert-dismissible'>
  //       <button type='button' class='close' data-dismiss='alert'>&times;</button>
  //        <strong> فشل</strong>  التعديل يرجى اختيار الحدث المراد تعديله";
 }
} else {
//  header('Location: myerrorpage.php');
}

$return_arr = array();
$row        = null;
if ($querysub) {

 $row                 = mysqli_fetch_row($querysub);
 $subEventID          = $row[0];
 $evevtID             = $row[1];
 $subeEventName       = $row[2];
 $subEventDescription = $row[3];

}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <title>تعديل الحدث الفرعي </title>
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
          <h4 class="panelTitle"> تعديل الحدث الفرعي </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivEditSubEvent" method="post">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                <select class="form-control" id="eventName" name="eventName">
                  <?php
                      while ($row = mysqli_fetch_array($query)):
                      if ($evevtID == $row['event_ID']) {

                        echo "<option value='" . $row['event_ID'] . "'  selected='selected' >" . $row['name_Event'] . "</option>";} else {
                        echo "<option value='" . $row['event_ID'] . "' >" . $row['name_Event'] . "</option>";
                      }

                  ?>
                  <?php endwhile;?>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث الفرعي </label>
                <input type="text" class="form-control" id="txtSubEventName" name="subEventName" value="<?php echo $subeEventName ?>"
                  required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtDescription" class="control-label">وصف الحدث الفرعي</label>
                <textarea type="textarea" class="form-control" id="txtDescription" rows="3" name="description" required> <?php echo $subEventDescription ?> </textarea>
              </div>
            </div>

            <a href="/tactic/manageSubEvent.php" class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
            <input type="submit" value="تعديل" name="update" class="btn btn-nor-primary btn-lg enable-overlay">

        </div>
        </form>

      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/subEvent.js"></script>
  <script>
    // this part for call navBar
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>