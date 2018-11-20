<?php
//conect to database
require_once 'php/connectTosql.php';
if(isset($_SESSION['organizerID']) ){
$organizerid = $_SESSION['organizerID'];
$sql = "SELECT ev.name_Event,ce.certificate_ID,ce.templateLocation FROM event ev INNER JOIN certificate ce
         ON ev.event_ID = ce.event_ID AND 	ev.organizer_ID='$organizerid' ";
// Search for  event name
if (isset($_GET['searchValue']) && $_GET['searchValue'] != '') {

 $searchValue = $_GET['searchValue'];

 $mainQuery = mysqli_query($con, $sql . " where  ev.name_Event like '%$searchValue%' "
 ) or die(mysqli_error($con));

} // end Search
// this query for present all badges that related to organizer
else {
  $mainQuery = mysqli_query($con, $sql) or die(mysqli_error($con));
 }

// TODO for sarch

///delete certificate
 if (isset($_GET['isDeleteAction']) && $_GET['isDeleteAction'] != '') {
  if (isset($_GET['certificateId']) && $_GET['certificateId'] != '') {
   //retreive the hidden id in modal
   $certificateId = $_GET['certificateId'];
   $sql1          = "delete from certificateimageinfo where certificateId = '$certificateId'";
   $sql           = "delete from certificate where certificate_ID = '$certificateId'";
   $query1         = mysqli_query($con, $sql1) or die(mysqli_error($con));
   $query         = mysqli_query($con, $sql) or die(mysqli_error($con));

   //succsess to retreive id

   if ($query & $query1 ) {
    $retVal = true;
    echo json_encode($retVal); //convert value to client side jQ
    exit;
   } else {
    $retVal = false;
    echo json_encode($retVal);
    exit;

   }

  } else  {
   echo " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            عملية حذف خاطئة الرجاء اختيار الشهادة المراد حذفها
          </div> ";

 }
}
}//end if ($_SESSION['organizerID'])
else{
    header("location:LogIn.php");
  }
?>


<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>إدارة الشهادات</title>

<link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css' />
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
                    <h4 class="panelTitle">إدارة الشهادات</h4>
                </div>
                <div class="panel-body">

                    <form action="managecertificate.php" class="managecertificatetFrm" method="Get">

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="eventName" class="control-label"> اسم الحدث </label>
                                <input type="text" class="form-control" id="txtEventName" name="eventName">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <input type="submit" value="بحث" name="update" class="btn btn-nor-primary btn-sm">
                                <a class="btn btn-nor-primary btn-sm" href="addCertificate.php"> إضافة شهادة</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <table class="table table-striped">
                <tr>
                    <th> اسم الحدث </th>
                    <th> خيارات </th>
                </tr>




    <?php

        while ($row = mysqli_fetch_array($mainQuery)):

        echo "<tr>";
        echo "<td>" . $row['name_Event'] . "</td>";
        echo "<td> <a id='aEditcertificate' title='تعديل' href='editCertificate.php?certificateid=" . $row['certificate_ID'] . "'><span class='fa fa-edit' style='font-size:24px;'></span></a>
                   <a href='#' id='aDeletCertificate' title='حذف' class='adelete' data-id=" . $row['certificate_ID'] . "><span  class=' fa fa-trash' style='font-size:24px;color:red;  '></span> </a>
                   <a title='تنزيل' href='download.php?file=" . $row['templateLocation'] . "'   data-id=" . $row['certificate_ID'] . "><span  class=' glyphicon glyphicon-download-alt ' style='font-size:20px;  '></span> </a></td>
        </tr>";

    ?>
	                <?php endwhile;?>


            </table>
        </div>


        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">حذف شهادة</h4>
                    </div>
                    <div class="modal-body">
                        <p>هل انت متأكد من حذف الشهادة</p>
                        <input type="hidden" id="hdCertificateId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <button type="button" id="btnConfirmDelete" class="btn btn-primary">تأكيد الحذف</button>
                    </div>
                </div>
            </div>
        </div>



        <script src="js/jquery.min.js"></script>
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