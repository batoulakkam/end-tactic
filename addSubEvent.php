<?php
require_once('php/connectTosql.php');
$message="";
if (isset($_SESSION['emailconfirm']) and $_SESSION['emailconfirm'] == 1) {
$organizerid=$_SESSION['organizerID'];
  // this section for get the event name fro DB
  $query = mysqli_query($con,"SELECT * FROM event where organizer_ID=  '$organizerid' ")or die(mysqli_error($con));


if(isset($_POST['add'])){
  $eventID = $_POST["addSubEvent"];
  $subName = $_POST["subEventName"];
  $disSub = $_POST["subDescription"];
  $sql = mysqli_query($con, "INSERT INTO subevent ( subevent_ID, event_ID, nameSubEvent ,description_subevent) VALUES ('','$eventID','$subName','$disSub')")or die(mysqli_error());
if($sql){
header("location: /tactic/manageSubEvent.php");
}
   else{
    $message= " <div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
   <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
 </div> ";
  } 

}// end if(isset($_POST['add']))
} else {
  $message= " <div class='alert alert-danger alert-dismissible'>
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <strong> يرجى</strong>   تثبيت الايميل لكي تتمكن من أضافة حدث
        </div> ";
 }

?>

<!DOCTYPE html>
<html lang="ar">
<head>
<title>إضافة حدث فرعي  </title>
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

    <script src="jquery.js"></script> 
    
</head>



<body>
  <div id="includedContent"></div>
  <div id="includedContent2"></div>
  <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle"> إضافة حدث فرعي </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDiv" method="post">
          <?php 
            echo $message;
            ?>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                <select class="form-control" id="addSubEvent" name="addSubEvent" >
                  <?php
                  while ($row = mysqli_fetch_array($query)):
                  echo "<option value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>";
                  ?>
                  <?php endwhile;?>
     
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث الفرعي</label>
                <input type="text" class="form-control" id="txtSubEventName"  name="subEventName"
                  required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtDescription" class="control-label">وصف الحدث الفرعي </label>
                <textarea type="textarea" class="form-control" id="txtDescription" rows="3" name="subDescription" ></textarea>
              </div>
            </div>

           <a  href="/tactic/manageEvent.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
            <input type="submit" value="إضافة" name="add" class="btn btn-nor-primary btn-lg enable-overlay">

        </div>
        </form>

      </div>
    </div>
  </div>
  

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>
</html>
