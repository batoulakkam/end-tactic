<?php
// connect to DB
require_once 'php/connectTosql.php';

// this section for get the event name fro DB
$query = mysqli_query($con, "SELECT * FROM event") or die(mysqli_error());
if (isset($_POST['add']) && !empty($_FILES["fileToUpload"]["name"])) {

 $eventId = $_POST['eventId'];

 $checkQuery = mysqli_query($con, "SELECT * FROM certificate WHERE event_ID='$eventId'") or die(mysqli_error());

 if (mysqli_num_rows($checkQuery)>0) {
  echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط بشهادة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {

  $name     = $_FILES['fileToUpload']['name'];
  $size     = $_FILES['fileToUpload']['size'];
  $type     = $_FILES['fileToUpload']['type'];
  $tmp_name = $_FILES['fileToUpload']['tmp_name'];
  $location = "UploadFile/";

  $max_size = 100000;
  if ($size <= $max_size) {
   if (move_uploaded_file($tmp_name, $location . $name)) {

    // add info of new badge to the DB

    $sql = mysqli_query($con, "INSERT INTO certificate (event_ID,templateName,templateSize,templateType, templateLocation)
   VALUES ('$eventId','$name' ,'$size', '$type', '$location$name')") or die(mysqli_error($con));
    ///Check if add badge to DB has been done Successfully
    if ($sql) {
     header("location: /tactic/manageCertificate.php");
    } else {
     echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
        </div> ";
    }
   } else {
    echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  يوجد خطأ في حفظ الملف
        </div> ";

   }
  } else {
// for size message
    echo " <div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong> يرجى</strong>  أكبر حجم للملف هو 10 ميغا
            </div> ";
  }
 }
}
?>


<!DOCTYPE html>
<html lang="ar">

<head>
  <title>إضافة شهادة </title>
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
          <h4 class="panelTitle"> إضافة شهادة </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivAddCertificate" method="post" enctype="multipart/form-data">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <select class="form-control" id="eventId" name="eventId" >
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
                <label for="eventName" class="control-label"> ارفاق قالب الشهادة<label style="color:red">*&nbsp; </label></label>
                <input type="file" class="form-control" id="fileToUpload"  name="fileToUpload" >
              </div>
            </div>



           <a  href="/tactic/manageCertificate.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
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
  <script src="js/appjs/certificate.js"></script>
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