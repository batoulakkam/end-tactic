<?php
//conect to database
require_once 'php/connectTosql.php';
$message     = "";
$organizerid = $_SESSION['organizerID'];
$sql = "SELECT ev.name_Event,pr.prize_ID ,pr.namePrize ,pr.subevent_ID,COUNT(attwin.Id) as winnerCount
    FROM event ev INNER JOIN prize pr ON ev.event_ID = pr.event_ID 
    left join attendeewinners attwin on pr.prize_ID=attwin.prizeid
    ";
///search 
if (isset($_GET['searchValue']) && $_GET['searchValue'] != '') {
 $searchValue = $_GET['searchValue'];

 $mainQuery = mysqli_query($con, $sql . " where  name_Event like '%$searchValue%' or namePrize like '%$searchValue%' GROUP by(pr.prize_ID) "
 ) or die(mysqli_error($con));

} else {
 $mainQuery = mysqli_query($con, $sql . "GROUP by(pr.prize_ID)") or die(mysqli_error($con));
}

///delete prize
if (isset($_GET['isDeleteAction']) && $_GET['isDeleteAction'] != '') {
 if (isset($_GET['prizeId']) && $_GET['prizeId'] != '') {
  //retreive the hidden id in modal
  $prizeID = $_GET['prizeId'];
  $sql     = "delete from  prize  WHERE  Prize_ID = '$prizeID'";
  $query   = mysqli_query($con, $sql) or die(mysqli_error($con));
  //succsess to retreive id
  if ($query) {
   $retVal = true;
   echo json_encode($retVal); //convert value to client side jQ
   exit;
  } else {
   $retVal = false;
   echo json_encode($retVal);
   exit;
  }
 } else {
  echo " <div class='alert alert-danger alert-dismissible'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
            عملية حذف خاطئة الرجاء اختيار البطاقة المراد حذفها
          </div> ";
 }
}


?>
<html>
<head>
<title>إدارة الجوائز</title>

<link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">

<link rel="stylesheet" href="css/layouts/custom.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/icon.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/main-rtl.css">

<link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />



</head>

<body>
    <div id="includedContent"></div>
    <div id="includedContent2"></div>

    <div class="mainContent">

        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panelTitle">إدارة الجوائز</h4>
                </div>
                <div class="panel-body">

                    <form action="managePrize.php" class="managePrizeFrm" method="Get">

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="searchValue" class="control-label">البحث عن جائزة : </label>
                                <input type="text" class="form-control" id="txtSearchValue" name="searchValue" placeholder="بحث باسم الحدث او اسم الجائزة  ...">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <input type="submit" value="بحث" name="update" class="btn btn-nor-primary btn-sm" style="width:145px">
                                <a class="btn btn-nor-primary btn-sm" href="addPrize.php"> إضافة جائزة جديدة</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <table class="table table-striped">
                <tr>
                    <th>  الجائزة  </th>
                    <th>  اسم الحدث</th>
                    <th>  اسم الحدث الفرعي </th>
                    <th> خيارات </th>
                </tr>




<?php
while ($row = mysqli_fetch_array($mainQuery)):
 $subeventid = $row['subevent_ID'];
 echo "<tr>";
 echo "<td><a  title='مشاهدة التفاصيل' href='prizeDetails.php?prizeId=" . $row['prize_ID'] . "'>" . $row['namePrize'] . "</a></td>";
 echo "<td>" . $row['name_Event'] . "</td>";
 $querysub = mysqli_query($con, "SELECT nameSubEvent ,subevent_ID from subevent where subevent_ID= '$subeventid'") or die(mysqli_error($con));
 $rows     = mysqli_fetch_array($querysub);

 if ($rows[0] != "") {
  echo "<td>" . $rows[0] . "</td>";
 } else {
  echo "<td> لا يوجد </td>";
 }

 echo "<td> <a id='aEditsubEvent' title='تعديل' href='editPrize.php?prizeId=" . $row['prize_ID'] . "'><span class='fa fa-edit' style='font-size:24px;'></span></a>
                    <a href='#' title='حذف' id='aDeletPrize' class='adelete' data-id=" . $row['prize_ID'] . "><span  class=' fa fa-trash' style='font-size:24px;color:red;  '></span> </a>
                    <a title=" .($row['winnerCount']==0? 'إختيار الفائزين' : 'تم الإختيار' ) . " id='aChooseWinner' class='aChooseWinner' href='prizeWinner.php?prizeId=" . $row['prize_ID'] . "&subEventId=". $subeventid . "'><span  class='fa fa-trophy' style='font-size:24px;color:#FFD700;'></span> </a></td>
			      </tr>";
 ?>
	         <?php endwhile;?>




            </table>
        </div>
	</div>


        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">حذف  جائزة</h4>
                    </div>
                    <div class="modal-body">
                        <p>هل انت متأكد من حذف الجائزة</p>
                        <input type="hidden" id="hdPrizeId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                        <button type="button" id="btnConfirmDelete" class="btn btn-primary">تأكيد الحذف</button>
                    </div>
                </div>
            </div>
        </div>



        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/appjs/prize.js"></script>
        <script src="js/appjs/common.js"></script>

        <script>
            $(function () {
                $("#includedContent").load("php/TopNav.php");
                $("#includedContent2").load("HTML/rightNav.html");
            });
        </script>

</body>

</html>