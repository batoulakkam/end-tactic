<?php
// connect to DB
require_once 'php/connectTosql.php';
if(isset($_SESSION['organizerID']) ){
$organizerid = $_SESSION['organizerID'];
$certificateIdForEdit=$_GET['certificateid'];
$message = "";

function calculateX($value) 
{
 $yposition = strpos($value, "Y");
 $xpostion  = strpos($value, "X");
 $left      = substr($value, $xpostion + 1, $yposition - 1);
 return $left;
}

function calculateY($value)
{
 $yposition = strpos($value, "Y");
 $top       = substr($value, $yposition + 1);
 return $top;
}
// this section for get the event name fro DB
$query = mysqli_query($con, "SELECT * FROM event where organizer_ID=  '$organizerid'") or die(mysqli_error());
//get the value of drop-down list for font color and font size from DB
$color    = mysqli_query($con, "SELECT * FROM color ") or die(mysqli_error());
$fontsize = mysqli_query($con, "SELECT * FROM fontsize ") or die(mysqli_error());

$certificateInfo = mysqli_query($con, "SELECT * FROM  certificate c  INNER JOIN certificateimageinfo info ON c.certificate_ID = info.certificateId
    where c.certificate_ID='$certificateIdForEdit ' ")
    or die(mysqli_error());

    $row = mysqli_fetch_array($certificateInfo);
    $certificateIdEdit=$row[0];
    $eventIdEdit=$row[1];
    $name=$row[2];     
    $type=$row[3];     
    $tmp_name=$row[4]; 
    $location=$row[5];
    $IdcertificateImgEdit=$row[6];
    $colorEdit=$row[7];
    $fontSizeEdit=$row[8];
    $eventnamepositionEdit=$row[10];
    $visitornamepositionEdit=$row[11];
    $eventdatepositionEdit=$row[12];
    $imagepositionEdit=$row[13];


if (isset($_POST['add'])) {

 $eventId     = $_POST['eventId'];
 $color       = $_POST["color"];
 $fontSize    = $_POST["fontSize"];
 $eventNamePosition   = $_POST["eventNamePosition"];
 $imagePosition       = $_POST["imagePosition"];
 $visitorNamePosition = $_POST["visitorNamePosition"];
 $eventDatePosition   = $_POST["eventDatePosition"];

// check if the event allredy have certificate or not 
 if ($eventIdEdit!= $eventId ){
  $checkQuery    = mysqli_query($con, "SELECT * FROM certificate WHERE event_ID='$eventId'") or die(mysqli_error());
  if (mysqli_num_rows($checkQuery) > 0) {
    $chech=false; 
  }else{
    $chech=true;} 
 }else{
  $chech=true;}


 if (!$chech) {
  $message = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط بشهادة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {
if (!empty($_FILES["fileToUpload"]["name"])) {
  $name     = $_FILES['fileToUpload']['name'];
  $size     = $_FILES['fileToUpload']['size'];
  $type     = $_FILES['fileToUpload']['type'];
  $tmp_name = $_FILES['fileToUpload']['tmp_name'];
  $extention=substr($type,6);
  $location = "UploadFile/" . $eventId . "/certificate.".$extention;

  $max_size = 1000000;
  if ($size <= $max_size) {
    // check the type of image
   if ($type == "image/jpg" || $type == "image/JPG" || $type == "image/jpeg" || $type == "image/JPEG") {
   if (move_uploaded_file($tmp_name, $location)) {
true;
    
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
$message = "<div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
             تنبيه أكبر حجم للملف هو 10 ميغا
          </div> ";

  }
  }// end if (!empty($_FILES["fileToUpload"]["name"]))
 
 // add info of new certificate to the DB

$mainQuery = mysqli_query($con, "UPDATE  certificate set event_ID='$eventId',templateName='$name',templateSize='$size',
templateType='$type',templateLocation='$location' where certificate_ID='$certificateIdEdit'") or die(mysqli_error($con));


    $imageQuery = mysqli_query($con, "UPDATE certificateimageinfo set color='$color',fontSize='$fontSize' ,certificateId='$certificateIdEdit',
    eventnameposition='$eventNamePosition',visitorNameposition='$visitorNamePosition ',eventDateposition='$eventDatePosition',
    imagePosition='$imagePosition' where Id='$IdcertificateImgEdit' ") or die(mysqli_error($con));

    ///Check if add certificate to DB has been done Successfully
    if ($mainQuery & $imageQuery) {
     header("location:manageCertificate.php");
    } else {
     $message = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
        </div> ";
    }
}
}//end if (isset($_POST['add']))
}//end if ($_SESSION['organizerID'])
else{
  header("location:LogIn.php");
}
?>


<!DOCTYPE html>
<html lang="ar">

<head>
  <title>تعديل  شهادة </title>
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
  <link rel="stylesheet" href="css/print.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <link rel="shortcut icon" href="image/logo.png" type="image/x-icon" />


  <!-------------------------------------------------------------------------->

</head>

<body>
  <div id="includedContent"></div>
  <div id="includedContent2"></div>
  <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle"> تعديل شهادة </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivEditCertificate" method="post" enctype="multipart/form-data">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventId" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <select class="form-control" id="eventId" name="eventId">
                  <?php
                    while ($row = mysqli_fetch_array($query)):
                    if($row['event_ID']==$eventIdEdit){
                      echo "<option selected='selected' value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>"; 
                  }else{
                      echo "<option value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>";
                  }
                  endwhile;?>

                </select>
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="fileToUpload" class="control-label"> ارفاق قالب الشهادة</label>
                <input type="file" class="form-control" onchange="readURL(this);" id="fileToUpload" name="fileToUpload">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-lg">
                <label for="color" class=" control-label"> لون الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="color" name="color">

                  <?php
                    while ($row = mysqli_fetch_array($color)):
                      if ($row['value']==$colorEdit){
                        echo "<option selected='selected' value='" . $row['value'] . "'>" . $row['name'] . "</option>"; 
                      }else{
                          echo "<option value='" . $row['value'] . "'>" . $row['name'] . "</option>";
                      }
                    
                    endwhile;?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group form-group-lg">
                <label for="fontSize" class="control-label"> حجم الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="fontSize" name="fontSize">

                  <?php
                      while ($row = mysqli_fetch_array($fontsize)):
                        if ($row['size']== $fontSizeEdit){
                          echo "<option selected='selected' value='" . $row['size'] . "'>" . $row['size'] . "</option>";
                      }else{
                          echo "<option value='" . $row['size'] . "'>" . $row['size'] . "</option>";
                      }

                      endwhile;?>
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
                  <?php //X294.171875Y598
                  $leftPosition=calculateX($eventnamepositionEdit);
                  $topPosition=calculateY($eventnamepositionEdit);
                 $topImg=calculateY($imagepositionEdit);
                  $leftImg=calculateX($imagepositionEdit);
                  if($leftPosition>=0 && $leftPosition<=583.0937 && $topPosition>=0 && $topPosition<=585){
                      $leftPosition=floatval($leftPosition)+ floatval($leftImg);
                      $topPosition=floatval($topPosition)+floatval($topImg);
                      $leftImg=floatval($leftPosition)-658 ;
                      $topImg=floatval($topPosition)-537; 
                    echo "<label id='lblEventName' style='top:".$topImg."px; left:".$leftImg."px;' >اسم الحدث</label>";
                }
                  else
                  {
                    echo "<label id='lblEventName'>اسم الحدث</label>";
                  }
                  ?>
                  
                  </li>
                  <li class="list-group-item image-item-list">
                  <?php 
                  $leftPosition=calculateX($visitornamepositionEdit);
                  $topPosition=calculateY($visitornamepositionEdit);
                 $topImg=calculateY($imagepositionEdit);
                  $leftImg=calculateX($imagepositionEdit);
                  if($leftPosition>=0 && $leftPosition<=583.0937 && $topPosition>=0 && $topPosition<=585){
                    
                      $leftPosition=floatval($leftPosition)+ floatval($leftImg);
                      $topPosition=floatval($topPosition)+floatval($topImg);
                      $leftImg=floatval($leftPosition)-659.5 ;
                      $topImg=floatval($topPosition)-577; 
                    echo "<label id='lblVisitorName' style='top:".$topImg."px; left:".$leftImg."px;' >اسم الزائر</label>";
                }
                  else
                  {
                    echo "<label id='lblVisitorName'>اسم الزائر</label>";
                  }
                  ?>
                   
                  </li>
                  <li class="list-group-item image-item-list">
                  <?php 
                  $leftPosition=calculateX($eventdatepositionEdit);
                  $topPosition=calculateY($eventdatepositionEdit);
                 $topImg=calculateY($imagepositionEdit);
                  $leftImg=calculateX($imagepositionEdit);
                  if($leftPosition>=0 && $leftPosition<=583.0937 && $topPosition>=0 && $topPosition<=585){
                      $leftPosition=floatval($leftPosition)+ floatval($leftImg);
                      $topPosition=floatval($topPosition)+floatval($topImg);
                      $leftImg=floatval($leftPosition)-653.6;
                      $topImg=floatval($topPosition)-617; 
                    echo "<label id='lblEventDate' style='top:".$topImg."px; left:".$leftImg."px;' >تاريخ الحدث </label>";
                }
                  else
                  {
                    echo "<label id='lblEventDate'>تاريخ الحدث</label>";
                  }
                  ?>
                  </li>

                </ul>
              </div>


              <div class="certificate_container">
                <div class="form-group form-group-lg">

                  <img id="myImg"  class="certificatealign" src=<?php echo $location;?> />

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