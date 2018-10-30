<?php
// connect to DB
require_once 'php/connectTosql.php';
$message="";
$organizerID  = $_SESSION['organizerID'];
// this section for get the event name from DB for curent organizer
$query = mysqli_query($con, "SELECT * FROM event where organizer_ID='$organizerID ' ") or die(mysqli_error());
//get the value of drop-down list for barcode size, font color and font size from DB
$barcodesize = mysqli_query($con, "SELECT * FROM barcodesize ") or die(mysqli_error());
$color = mysqli_query($con, "SELECT * FROM color ") or die(mysqli_error());
$fontsize=mysqli_query($con, "SELECT * FROM fontsize ") or die(mysqli_error());

// to get the badge type from lookup tabel
$badgeTypeQuery = mysqli_query($con, "SELECT * FROM badgetype") or die(mysqli_error());


if ( !empty($_FILES["fileToUpload"]["name"])) {

 $eventId     = $_POST['eventId'];
 $badgeTypeId = $_POST['badgeTypeId'];
 $checkQuery  = mysqli_query($con, "SELECT * FROM badge WHERE event_ID='$eventId' and
 BadgeTypeId='$badgeTypeId'
  ") or die(mysqli_error());

 if (mysqli_num_rows($checkQuery) > 0) {
  $message= " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط ببطاقة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {

  $name     = $_FILES['fileToUpload']['name'];
  $size     = $_FILES['fileToUpload']['size'];
  $type     = $_FILES['fileToUpload']['type'];
  $tmp_name = $_FILES['fileToUpload']['tmp_name'];
  
// add eventId & badgeTypeId to the name of file to make sure the name is unique
  $location = "UploadFile/badges/".$eventId .$badgeTypeId.$name;
  //$location = "UploadFile/badges/Captureclasssmall.png";
  $max_size = 100000;
  if ($size <= $max_size) {
    // check the type of image 
    if ($size=="jpg"|| $size=="JPG" ){
      // save image in Specific position 
   if (move_uploaded_file($tmp_name, $location)) {
    // add info of new badge to the DB
if (isset($_POST['add']))  {

      $text=$_POST["text"];
      $x_yposition =$_POST["valueposition"];
      $color=$_POST["color"];
      $barSize=$_POST["barSize"];
      $fontSize=$_POST["fontSize"];

    $sql = mysqli_query($con, "INSERT INTO badge (BadgeTypeId,event_ID,badgeTemplateName,badgeTemplateSize,badgeTemplateType,badgeTemplateLocation)
   VALUES ('$badgeTypeId','$eventId','$name' ,'$size', '$type', '$location')") or die(mysqli_error($con));
// get the badge id to insert it to imageinfo table 
    $badgeID = mysqli_query($con,"SELECT badge_ID  FROM badge where event_ID ='$eventId' AND BadgeTypeId='$badgeTypeId' ")or die(mysqli_error());
    $row = mysqli_fetch_array($badgeID);
    $badgeId =$row['badge_ID'];

    $sqlimage = mysqli_query($con, "INSERT INTO imageinfo (image_ID ,x_yposition ,color ,barSize ,fontSize ,badge_ID)
    VALUES ('','$x_yposition','$color','$barSize','$fontSize','$badgeId')") or die(mysqli_error($con));
    ///Check if add badge to DB has been done Successfully
    if ($sql & $sqlimage) {
     header("location: /tactic/manageBadge.php");
    } else {
     $message=" <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  لم تتم عملية الاضافة بنجاح يرجى التحقق
        </div> ";
    }
} /*else {
    $message= " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  يوجد خطأ في حفظ الملف
        </div> ";

   }*/
  }// end if (isset($_POST['add']))
   
  } else {
// for size message
$message= " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> يرجى</strong>  أكبر حجم للملف هو 10 ميغا
          </div> ";
  }
} else 
$message= " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong> يرجى</strong>  التحقق من صيغة الملف يجب ان تكون jpg
          </div> ";
 }
}// end if ( !empty($_FILES["fileToUpload"]["name"]))
?>


<!DOCTYPE html>
<html lang="ar">

<head>
  <title>إضافة بطاقة </title>
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
          <h4 class="panelTitle"> إضافة بطاقة </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivAddBadge" method="post" enctype="multipart/form-data">

            <?php echo $message; ?>

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
                <label for="badgeType" class="control-label"> نوع البطاقة</label>
                <select class="form-control" id="badgeType" name="badgeTypeId" >
                  <?php
while ($row = mysqli_fetch_array($badgeTypeQuery)):
 echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
 ?>
				                  <?php endwhile;?>

                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> ارفاق قالب البطاقة<label style="color:red">*&nbsp; </label></label>
                <input type="file" class="form-control" onchange="readURL(this);"  id="fileToUpload"  name="fileToUpload">
              </div>
            </div>
        
            
            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="valueposition" class="control-label">موقع اضافة معلومات الزائر<label style="color:red">*&nbsp; </label></label>
              <input type="" class="form-control" id="valueposition"  name="valueposition" >
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group form-group-lg">
                <label for="color" class=" control-label"> لون الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="color" name="color" >
                <option value=""> اختيار </option >
                  <?php
                    while ($row = mysqli_fetch_array($color)):

                    echo "<option value='" . $row['	value'] . "'>" . $row['name'] . "</option>";
                    ?>
                    <?php endwhile;?> 
                </select>
              </div>
            </div>

            <div class="col-md-4">
             <div class="form-group form-group-lg">
                <label for="fontSize" class="control-label"> حجم الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="fontSize" name="fontSize" >
                <option value=""> اختيار </option >
                <?php
                    while ($row = mysqli_fetch_array($fontsize)):

                    echo "<option value='" . $row['	size'] . "'>" . $row['size'] . "</option>";
                    ?>
                    <?php endwhile;?> 
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group form-group-lg">
                <label for="barSize" class=" control-label"> حجم الباركود <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="barSize" name="barSize" >
                <option value=""> اختيار </option >
                <?php
                    while ($row = mysqli_fetch_array($barcodesize)):

                    echo "<option value='" . $row['	size'] . "'>" . $row['name'] . "</option>";
                    ?>
                    <?php endwhile;?> 
                </select>
              </div>
            </div>

              <div class="col-md-12">
              <div class="form-group form-group-lg">
                  <span  id="myImg"> </span>
                 
             </div>
              </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
              
                <a href="/tactic/manageBadge.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
                <input type="submit" value="إضافة" name="add" class="btn btn-nor-primary btn-lg enable-overlay">
                <button type="button" id ="passImageIfon" name="passImageIfon" class="btn btn-nor-primary btn-lg enable-overlay" > hh تطبيق </button>
          
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

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/badge.js"></script>
  <script src="js/appjs/common.js"></script>
  <script>
  // this part for call navBar
    $(function () {
      //$("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script>

</body>
</html>