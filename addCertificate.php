<?php
// connect to DB
require_once 'php/connectTosql.php';
$organizerid = $_SESSION['organizerID'];
$message = "";

// this section for get the event name fro DB
$query = mysqli_query($con, "SELECT * FROM event where organizer_ID=  '$organizerid'") or die(mysqli_error());
//get the value of drop-down list for font color and font size from DB
$color    = mysqli_query($con, "SELECT * FROM color ") or die(mysqli_error());
$fontsize = mysqli_query($con, "SELECT * FROM fontsize ") or die(mysqli_error());

if (isset($_POST['add']) && !empty($_FILES["fileToUpload"]["name"])) {

 $eventId     = $_POST['eventId'];
 $color       = $_POST["color"];
 $fontSize    = $_POST["fontSize"];
 $eventNamePosition   = $_POST["eventNamePosition"];
 $imagePosition       = $_POST["imagePosition"];
 $visitorNamePosition = $_POST["visitorNamePosition"];
 $eventDatePosition   = $_POST["eventDatePosition"];


 $checkQuery    = mysqli_query($con, "SELECT * FROM certificate WHERE event_ID='$eventId'") or die(mysqli_error());
 // get the certificate id to insert it to certificateimageinfo table
 $row           = mysqli_fetch_array($checkQuery);
 $certificateId = $row['certificate_ID'];

 if (mysqli_num_rows($checkQuery) > 0) {
  echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط بشهادة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {

  $name     = $_FILES['fileToUpload']['name'];
  $size     = $_FILES['fileToUpload']['size'];
  $type     = $_FILES['fileToUpload']['type'];
  $tmp_name = $_FILES['fileToUpload']['tmp_name'];
  $location = "UploadFile/" . $eventId . "/" .$eventId . "." . $name;

  $max_size = 1000000;
  if ($size <= $max_size) {
    // check the type of image
   if ($type == "image/jpg" || $type == "image/JPG" || $type == "image/jpeg" || $type == "image/JPEG") {
   if (move_uploaded_file($tmp_name, $location /*. $name*/)) {

    // add info of new certificate to the DB

    $mainQuery = mysqli_query($con, "INSERT INTO certificate
    (event_ID,templateName,
    templateSize,templateType, templateLocation)
   VALUES ('$eventId','$name' ,'$size', '$type', '$location$name')") or die(mysqli_error($con));


    $imageQuery = mysqli_query($con, "INSERT INTO certificateimageinfo (Id ,color,fontSize ,certificateId,eventnameposition,visitorNameposition,eventDateposition,imagePosition )
    VALUES ('','$color','$fontSize','$certificateId','$eventNamePosition','$visitorNamePosition ','$eventDatePosition', '$imagePosition')") or die(mysqli_error($con));

    ///Check if add certificate to DB has been done Successfully
    if ($mainQuery & $imageQuery) {
     header("location: /tactic/manageCertificate.php");
    } else {
     $message = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
        </div> ";
    }
    } else {
     $message = " <div class='alert alert-danger alert-dismissible'>
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  يوجد خطأ في حفظ الملف
         </div> ";

    }
    } else {
    // for size message
    $message = " <div class='alert alert-danger alert-dismissible'>
             <button type='button' class='close' data-dismiss='alert'>&times;</button>
             يرجى التحقق من صيغة الملف يجب ان تكون من نوع (JPG)(JPEG)
             </div> ";
   }
  } else {
// for size message
   echo "<div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
             تنبيه أكبر حجم للملف هو 10 ميغا
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
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

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
                <label for="eventId" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <select class="form-control" id="eventId" name="eventId">
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
                <label for="fileToUpload" class="control-label"> ارفاق قالب الشهادة<label style="color:red">*&nbsp;
                  </label></label>
                <input type="file" class="form-control" onchange="readURL(this);" id="fileToUpload" name="fileToUpload">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-lg">
                <label for="color" class=" control-label"> لون الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="color" name="color">

                  <?php
                          while ($row = mysqli_fetch_array($color)):

                          echo "<option value='" . $row['value'] . "'>" . $row['name'] . "</option>";
                          ?>
		                  <?php endwhile;?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-lg">
                <label for="fontSize" class="control-label"> حجم الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="fontSize" name="fontSize">

                  <?php
                      while ($row = mysqli_fetch_array($fontsize)):

                      echo "<option value='" . $row['size'] . "'>" . $row['size'] . "</option>";
                      ?>
		                  <?php endwhile;?>
                </select>
              </div>
            </div>
<input type="hidden" id ="eventNamePosition" name="eventNamePosition" value="">
<input type="hidden" id ="visitorNamePosition" name="visitorNamePosition" value="">
<input type="hidden" id ="eventDatePosition" name="eventDatePosition" value="">
<input type="hidden" id ="imagePosition" name="imagePosition" value="">
            
            <div class="image-header">
              <h4> اسحب العناصر التالية لتحديد مكانها على الصورة </h4>

              <div class="image-items">
                <ul class="image-group">
                  <li class="list-group-item image-item-list">
                    <label id="lblEventName"> اسم الحدث</label>
                  </li>
                  <li class="list-group-item image-item-list">
                    <label id="lblVisitorName"> اسم الزائر </label>
                  </li>
                  <li class="list-group-item image-item-list">
                    <label id="lblEventDate"> تاريخ الحدث </label>
                  </li>

                </ul>
              </div>


              <div class="certificate_container">
                <div class="form-group form-group-lg">

                  <img id="myImg"  class="certificatealign" src="image/certificate.jpg" />

                </div>
              </div>

            </div>




            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <a href="/tactic/manageCertificate.php" class="bodyform btn btn-nor-danger btn-sm">عودة</a>
                <input type="submit" value="حفظ التغيرات" id ="add" name="add" class="btn btn-nor-primary btn-lg enable-overlay">
                <button type="button" id="passImageInfo" name="passImageInfo" class="btn btn-nor-primary btn-lg enable-overlay">
                  معاينة الصورة </button>
              </div>
            </div>

    </div>
    </form>

  </div>
  </div>
  </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="viewAttendeeCertificate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> معاينة الشهادة</h4>
      </div>
     <div class="certificate_container">
      <div class="modal-body"id ="printCertificate">
      <img sur="#" id="viewCertificate" />
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
        <button type="button" id="btnPrintCertificate" class="btn btn-primary" > طباعة</button>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#myImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/certificate.js"></script>
  <script src="js/appjs/common.js"></script>
  <script>
    // this part for call navBar
    $(function () {
      // $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>