<?php
require_once 'php/connectTosql.php';
$organizerid = $_SESSION['organizerID'];

if (isset($_POST['update'])) {
 $certificateId = $_GET['certificateId'];
 $eventId       = $_POST['eventId'];
 $fileDeatils   = '';
// check that the event relate just to one certificate
 $checkQuery = mysqli_query($con, "SELECT * FROM certificate 
 WHERE event_ID='$eventId' and certificate_ID!='$certificateId'") or die(mysqli_error());

 if (mysqli_num_rows($checkQuery) > 0) {
  echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط بشهادة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {
  // in case user upload new file we need to process it or i don't want to check anything about file
  // when error=UPLOAD_ERR_OK this mean file upload without any error
  if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {

   $name     = $_FILES['fileToUpload']['name'];
   $size     = $_FILES['fileToUpload']['size'];
   $type     = $_FILES['fileToUpload']['type'];
   $tmp_name = $_FILES['fileToUpload']['tmp_name'];

   $location = "UploadFile/certificate/";

   $max_size = 100000;
   if ($size <= $max_size) {
    if (move_uploaded_file($tmp_name, $location . $name)) {

     $fileDeatils = " ,templateName='$name',
                            templateSize='$size',
                            templateType='$type',
                            templateLocation='$location$name' ";
    } else {
     // file saved in files directory
     echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  يوجد خطأ في حفظ الملف
        </div> ";

    }
   } else // for check the size of image
   {
    echo " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> يرجى</strong>  أكبر حجم للملف هو 10 ميغا
          </div> ";
   }
  } // end if file exist

  $sql = " UPDATE certificate SET
                            event_ID='$eventId'
                             $fileDeatils
                            WHERE certificate_ID ='$certificateId' ";

  $sql = mysqli_query($con, $sql) or die(mysqli_error($con));
  if ($sql) {
   header("location: /tactic/manageCertificate.php");
   exit;
  } else {
   echo " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  لم تتم عملية التعديل بنجاح يرجى التحقق
       </div> ";
  }
 }
}

// for get the recoed of badge when page load // get type
if (isset($_GET['certificateId'])) {

 $certificateId = $_GET['certificateId'];
 // to fill drop down list of events
 $eventQuery = mysqli_query($con, "SELECT * FROM event where organizer_ID=  '$organizerid'") or die(mysqli_error($con));

 // to get the record of certificate that already added from add page
 $certificateQuery = mysqli_query($con, "SELECT * FROM certificate where certificate_ID=$certificateId") or die(mysqli_error($con));

 $row = mysqli_fetch_row($certificateQuery);

 $eventId          = $row[1];
 $templateLocation = $row[5];

}
?>
<!DOCTYPE html>
<html>

<head>
  <title>تعديل شهادة </title>
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
          <h4 class="panelTitle" >تعديل شهادة </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivEditCertificate" method="post"enctype="multipart/form-data">
<div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventId" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <select class="form-control" id="eventId" name="eventId"  >
                <?php echo '<option  value=" ">الرجاء الاختيار</option>';

while ($row = mysqli_fetch_array($eventQuery)):
 echo '<option  value="' . $row['event_ID'] . '" ' . ($eventId == $row['event_ID'] ? ' selected="selected"' : '') . '>' . $row['name_Event'] . '</option>';
 ?>

	                                                      <?php endwhile;?>

                </select>
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="fileToUpload" class="control-label"> ارفاق قالب الشهادة<label style="color:red">*&nbsp; </label></label>
                <input type="file" class="form-control" id="fileToUpload"  name="fileToUpload" >
               <?php echo "
               <div class='download-file-container'><p class='UploaderNotes'>في حال لم تقم بإرفاق ملف سيتم المحافظة على الملف القديم</p><p><a title='تحميل الملف'
                href='download.php?file=" . $templateLocation . "' data-id=" . $certificateId . ">تحميل الملف</a></p></div>"
?>
              </div>
            </div>



            <a  href="/tactic/manageCertificate.php"  class="bodyform btn btn-nor-danger btn-sm">عودة</a>
             <input type="submit" value="تعديل" name = "update" class="btn btn-nor-primary btn-lg enable-overlay">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/certificate.js"></script>
  <script src="js/appjs/common.js"></script>

  <script>
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>

</html>