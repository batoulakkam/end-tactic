<?php
require_once 'php/connectTosql.php';
if (isset($_SESSION['emailconfirm']) and $_SESSION['emailconfirm'] == 1) {
 if (isset($_POST['add'])) {
$eventName        = $_POST['eventName'];
$EventDescription = $_POST['description'];
$sdate            = $_POST['sdaytime'] . ' 00:00:00.000';
$datestart        = date('Y-m-d', strtotime($sdate));
$edate            = $_POST['edaytime'] . ' 00:00:00.000';
$dateend          = date('Y-m-d', strtotime($edate));
$location         = $_POST['location'];
$organizationName = $_POST['organizer'];
$maxAttendee      = $_POST['maxAttendee'];
  if ($datestart > $dateend) {
   echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل  </strong>  يرجى التحقق من تاريخ بداية ونهاية الحدث
       </div> ";
  } else {
   $IDT = $_SESSION['organizerID'];
   $sql = mysqli_query($con, "INSERT INTO event ( event_ID, name_Event, descrption_Event ,sartDate_Event,endDate_Event,location_Event,organization_name_Event,maxNumOfAttendee,organizer_ID) VALUES ('','$eventName','$EventDescription','$datestart','$dateend','$location','$organizationName','$maxAttendee','$IDT')") or die(mysqli_error($con));
   if ($sql) {
    header("location: /tactic/manageEvent.php");
   exit;
   } else {
    echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
       </div> ";
   }
  }}
} else {
 echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> يرجى</strong>   تثبيت الايميل لكي تتمكن من أضافة حدث
       </div> ";
}
?>


<!DOCTYPE html>
<html lang="ar">

<head>
  <title>إضافة حدث </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- lobrary of icon  fa fa- --->


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
          <h4 class="panelTitle">إضافة حدث </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivAddEvent" method="post">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <input type="text" class="form-control" id="txtEventName"  name="eventName"
                  >
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtOrganizer" class="control-label">اسم الشركة المنظمة<label style="color:red">*&nbsp; </label></label>
                <input type="text" class="form-control" id="txtOrganizer" name="organizer" 
                  >
              </div>
            </div>

             <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtMaxAttendee" class="control-label"> الحد الاقصى<label style="color:red">*&nbsp; </label></label>
                <select id="txtMaxAttendee" name="maxAttendee" class="form-control">
                  <option value="100"  >100</option>
                  <option value="200" >200</option>
                  <option value="500" >500</option>
                  <option value="1000" >1000</option>
                  <option value="1500" >1500</option>
                  <option value="2000" >2000</option>
                  <option value="unfinite" >غير
                    محدود</option>
                </select>
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtLocation" class="control-label">مكان الحدث<label style="color:red">*&nbsp; </label></label>
                <input type="text" class="form-control" id="txtLocation" name="location" 
                  >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtSdaytime" class="control-label">تاريخ بدء الحدث<label style="color:red">*&nbsp; </label></label>
                <input type="date" class="form-control" id="txtSdaytime" name="sdaytime" 
                  >
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtEdaytime" class="control-label">تاريخ نهاية الحدث<label style="color:red">*&nbsp; </label></label>
                <input type="date" class="form-control" id="txtEdaytime" name="edaytime" 
                  >
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="txtDescription" class="control-label">وصف الحدث<label style="color:red">*&nbsp; </label></label>
                <textarea type="textarea" class="form-control" id="txtDescription" rows="3" name="description" ></textarea>
              </div>
            </div>

           <a  href="/tactic/manageEvent.php"  class="bodyform btn btn-nor-danger btn-sm">عودة</a>
            <input type="submit" value="إضافة" name="add" class="btn btn-nor-primary btn-lg enable-overlay">

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