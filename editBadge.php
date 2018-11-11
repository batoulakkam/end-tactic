<?php
// connect to DB
require_once 'php/connectTosql.php';
$message="";
$organizerID  = $_SESSION['organizerID'];
$badgeIdForEdit=$_GET['badgeid'];

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

// this section for get the event name from DB for curent organizer
$query = mysqli_query($con, "SELECT * FROM event where organizer_ID='$organizerID ' ") or die(mysqli_error());
//get the value of drop-down list for barcode size, font color and font size from DB
$barcodesize = mysqli_query($con, "SELECT * FROM barcodesize ") or die(mysqli_error());
$color = mysqli_query($con, "SELECT * FROM color ") or die(mysqli_error());
$fontsize=mysqli_query($con, "SELECT * FROM fontsize ") or die(mysqli_error());

// to get the badge type from lookup tabel
$badgeTypeQuery = mysqli_query($con, "SELECT * FROM badgetype") or die(mysqli_error());

$badgeIfo = mysqli_query($con, "SELECT * FROM  badge b  INNER JOIN imageinfo img ON img.badgeId = b.badge_ID
    where b.badge_ID='$badgeIdForEdit ' ")
    or die(mysqli_error());

    $row = mysqli_fetch_array($badgeIfo);
    $eventIdEd= $row[2];
    $BadgeTypeEd= $row[1];
    $colorEd=$row[8];
    $barSizeEd=$row[9];
    $fontSizeEd=$row[10];
    $imageEd=$row[6];
    $imageinfoId=$row[7];
    $namePosition=$row[12];
    $careerPosition=$row[13];
    $barcodePosition=$row[14];
    $imagePosition=$row[15];

    $name     = $row[3];
    $size     = $row[4];
    $type     = $row[5];
    $location = $row[6];
  $badgeName=substr($type,6);
  $chechUpload=0;
  if (isset($_POST['add']))  {
    $eventId     = $_POST['eventId'];
    $badgeTypeId = $_POST['badgeTypeId'];

 if ($BadgeTypeEd!= $badgeTypeId){
  $checkQuery  = mysqli_query($con, "SELECT * FROM badge WHERE event_ID='$eventId' and BadgeTypeId='$badgeTypeId'") or die(mysqli_error());
  if (mysqli_num_rows($checkQuery) > 0) {
    $chech=0; 
  }else{
    $chech=1;} 
 }else{
  $chech=1;}

 if ($chech== 0) {
  $message= " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  الحدث مرتبط ببطاقة مسبقا لايمكن اتمام العملية
        </div> ";

 } else {

if ( !empty($_FILES["fileToUpload"]["name"])) {

  $name     = $_FILES['fileToUpload']['name'];
  $size     = $_FILES['fileToUpload']['size'];
  $type     = $_FILES['fileToUpload']['type'];
  $tmp_name = $_FILES['fileToUpload']['tmp_name'];
$badgeName=substr($type,6);
// add eventId & badgeTypeId to the name of file to make sure the name is unique
  $location = "UploadFile/".$eventId."/".$badgeTypeId.$eventId.".".$badgeName;
  $chechUpload=1;
  // save image in Specific position 
  if (move_uploaded_file($tmp_name, $location)) {
    true;
  }else $message= " <div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong> فشل</strong>  يوجد خطأ في حفظ الملف
  </div> ";
}

  if ($chechUpload=1||$chechUpload=0){
  $max_size = 100000;
  if ($size <= $max_size) {
    // check the type of image 
    if ($type=="image/jpg"|| $type=="image/JPG" ||$type=="image/jpeg"|| $type=="image/JPEG"){
      
  
    // add info of new badge to the DB

  $visitorName    = $_POST["name"];//position 
  $visitorCareer  = $_POST["career"];//position
  $visitorBarcode = $_POST["barcode"];//position
  $imgPosition= $_POST["imgPosition"];//position
  $color=$_POST["color"];
  $barSize=$_POST["barSize"];
  $fontSize=$_POST["fontSize"];

    $sql = mysqli_query($con, "UPDATE badge set  BadgeTypeId='$badgeTypeId',event_ID='$eventId',badgeTemplateName='$name',badgeTemplateSize='$size',badgeTemplateType='$type',badgeTemplateLocation='$location'
   where badge_ID='$badgeIdForEdit' ") or die(mysqli_error($con));

$sqlimage = mysqli_query($con, "UPDATE  imageinfo set color='$color' ,barSize='$barSize' ,fontSize='$fontSize' ,badgeId='$badgeIdForEdit',namePosition='$visitorName ',careerPosition='$visitorCareer',
barcodePosition='$visitorBarcode',imgPosition='$imgPosition' where imageId='$imageinfoId'") or die(mysqli_error($con));
///Check if add badge to DB has been done Successfully
    if ($sql && $sqlimage) {
     header("location: /tactic/manageBadge.php");
    } else {
     $message=" <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong> فشل</strong>  لم تتم عملية التعديل بنجاح يرجى التحقق
        </div> ";
    }

  } else {
// for size message
$message= " <div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            يرجى التحقق من صيغة الملف يجب ان تكون من نوع (JPG)(JPEG)
            </div> ";
  }
} else 
$message= " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
             تنبيه أكبر حجم للملف هو 10 ميغا
            </div> ";
 }//end 
}// end else
} //end add 
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <title>تعديل بطاقة </title>
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

  <link rel="shortcut icon" href="image/logo.png" type="image/x-icon" />


  <!-------------------------------------------------------------------------->

</head>

<body>
  <div id="includedContent"></div>
  <div id="includedContent2"></div>

  <div class="mainContent">
    <div class="container printhide">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle"> تعديل بطاقة </h4>
        </div>
        <div class="panel-body">
          <form action="" class="formDivEditBadge" method="post" enctype="multipart/form-data">
            <?php echo $message; ?>
            <div class="col-md-12 ">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث<label style="color:red">*&nbsp; </label></label>
                <select class="form-control" id="eventId" name="eventId">
                  
                  <?php
                    while ($row = mysqli_fetch_array($query)):
                        if($row['event_ID']==$eventIdEd){
                            echo "<option selected='selected' value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>"; 
                        }else{
                            echo "<option value='" . $row['event_ID'] . "'>" . $row['name_Event'] . "</option>";
                        }
                    ?>
                  <?php endwhile;?>

                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="badgeType" class="control-label"> نوع البطاقة</label>
                <select class="form-control" id="badgeType" name="badgeTypeId">
                  <?php
                    while ($row = mysqli_fetch_array($badgeTypeQuery)):
                        if ($row['Id']==$BadgeTypeEd){
                            echo "<option selected='selected' value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";   
                        }else{
                            echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                        }
                    
                    ?>
                  <?php endwhile;?>

                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> ارفاق قالب البطاقة</label>
                <input type="file" class="form-control" onchange="readURL(this);" id="fileToUpload" name="fileToUpload">
                <!--<br> <label  class="btn-primary btn" for="files"  style="width:100; float:right;" > ارفع الملف</label>
                 <input type="file" onchange="readURL(this);" id="fileToUpload" name="fileToUpload"  style="visibility:hidden;" >&nbsp; <span  id="fileC" for= "files"> لم اختيار الملف</span>
                -->
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group form-group-lg">
                <label for="color" class=" control-label"> لون الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="color" name="color">

                  <?php
                    while ($row = mysqli_fetch_array($color)):
                        if ($row['value']==$colorEd){
                            echo "<option selected='selected' value='" . $row['value'] . "'>" . $row['name'] . "</option>"; 
                        }else{
                            echo "<option value='" . $row['value'] . "'>" . $row['name'] . "</option>";
                        }
                   endwhile;?>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group form-group-lg">
                <label for="fontSize" class="control-label"> حجم الخط <label style="color:red">*&nbsp; </label> </label>
                <select class="form-control" id="fontSize" name="fontSize">

                  <?php
                    while ($row = mysqli_fetch_array($fontsize)):
                    if ($row['size']== $fontSizeEd){
                        echo "<option selected='selected' value='" . $row['size'] . "'>" . $row['size'] . "</option>";
                    }else{
                        echo "<option value='" . $row['size'] . "'>" . $row['size'] . "</option>";
                    }
                    
                   endwhile;?>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group form-group-lg">
                <label for="barSize" class=" control-label"> حجم الباركود <label style="color:red">*&nbsp; </label>
                </label>
                <select class="form-control" id="barSize" name="barSize">

                  <?php
                    while ($row = mysqli_fetch_array($barcodesize)):
                        if ($row['size']==$barSizeEd){
                            echo "<option selected='selected' value='" . $row['size'] . "'>" . $row['name'] . "</option>";
                        }else{
                            echo "<option value='" . $row['size'] . "'>" . $row['name'] . "</option>";
                        }
                   
                    endwhile;?>
                </select>
              </div>
            </div>
<input type="hidden" id ="name" name="name" valu="">
<input type="hidden" id ="career" name="career" valu="">
<input type="hidden" id ="barcode" name="barcode" valu="">
<input type="hidden" id ="imgPosition" name="imgPosition" valu="">


            <div class="image-header">
              <h4> اسحب العناصر التالية لتحديد مكانها على الصورة </h4>

              <div class="col-md-5">
                <ul class="image-group">
                  <li class="list-group-item image-item-list" >
                  <?php
          /*
                  $leftPosition=calculateX($namePosition);
                  $topPosition=calculateY($namePosition);
                  $topImg=calculateY($imagePosition);
                  $leftImg=calculateX($imagePosition);
                  if($leftPosition>=16.9375 && $leftPosition<=212.9375){
                    if($topPosition>=5 && $topPosition<=327){
                      $leftImg= floatval($leftPosition)-16.9375;
                      $topImg=floatval($topPosition)+5;
                      
                    echo "<label id='lblVisitorName' style='top:".$topImg."px; left:".$leftImg."px' > اسم الزائر </label>";
                  }
                }
                  else
                  {*/
                    echo "<label id='lblVisitorName'> اسم الزائر </label>";
                 // }
                  ?>
                 <!--<label id="lblVisitorName"> اسم الزائر </label>-->
                  </li>
                  <li class="list-group-item image-item-list"  >
                  <?php
          /*
                  $leftPosition=calculateX($careerPosition);
                  $topPosition=calculateY($careerPosition);
                  $topImg=calculateY($imagePosition);
                  $leftImg=calculateX($imagePosition);
                  if($leftPosition>=16.9375 && $leftPosition<=212.9375){
                    if($topPosition>=5 && $topPosition<=327){
                      $leftImg= floatval($leftPosition);//+floatval($leftImg)
                      $topImg=floatval($topPosition);//+floatval($topImg)
                      
                    echo "<label id='lblCareer' style='top:".$topImg."px; left:".$leftImg."px' > مهنة الزائر </label>";
                  }
                }
                  else
                  {*/
                    echo "<label id='lblCareer'> مهنة الزائر </label>";
                  //}
                  ?>
                   
                  </li>
                  <li class="list-group-item image-item-list"   >
                  <?php
                  /* 
                  $barcodePosition="X584Y682";
                  $leftPosition=round(calculateX($barcodePosition));
                  $topPosition=calculateY($barcodePosition);
                  $topImg=calculateY($imagePosition);
                  $leftImg=calculateX($imagePosition);
                 if($leftPosition>=16.9375 && $leftPosition<=212.9375){
                    if($topPosition>=5 && $topPosition<=327){
                      $leftImg= floatval($leftPosition);//-floatval($leftImg)
                      $topImg=floatval($topPosition);//+floatval($topImg) 
                   
                    echo "<img id='dvBarcode'  src='image/bar.png' style='top:".$topPosition."px; left:".$leftPosition."px'/>";
                 }
                  }
                  else
                  {*/
                    echo "<img id='dvBarcode'  src='image/bar.png' />";
                 // }
                  ?>
                   
                  </li>
                  
                </ul>
              </div>


              <div class="col-md-5">
                <div class="form-group form-group-lg">

                  <img id="myImg" height="345px" width="217px" class="form-control badgealign" src=<?php echo $imageEd;?> />

                </div>
              </div>

            </div>

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <a href="/tactic/manageBadge.php" class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
                <input type="submit" value="تعديل" name="add" id="add" class="btn btn-nor-primary btn-lg enable-overlay">
                <button type="button" id="passImageIfon" name="passImageIfon" class="btn btn-nor-primary btn-lg enable-overlay">
                  معاينة الصورة </button>

              </div>
            </div>

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
  
   <div class="modal fade" id="viewAttendeeBadge" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> معاينة البطاقة التعريفية</h4>
      </div>
  
      <div class="modal-body">
      <img sur="" id="viewBadge" height="345px" width="217px"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
        <button type="button" id="btnPrintBadge" class="btn btn-primary"> طباعة</button>
      </div>
    </div>
  </div>
</div>


  <script type="text/javascript">
  
  /*
  $("#fileToUpload").change(function() {
        filename = this.files[0].name
        console.log(filename);
        });
        
        $("#fileToUpload").change(function() {
        $("#fileC").empty();
        $("#fileC").append(filename = this.files[0].name);
        });
*/

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
  <!-- end of  register inputs  -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/badge.js"></script>
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