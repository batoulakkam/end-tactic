<?php
require_once 'php/connectTosql.php';

if (isset($_GET['prizeId'])) {
    //جبت البيانات الخاصة بكل و ساويت جوين بين الجداول حسب الids 
   
    $prizeId     = filter_var($_GET['prizeId'], FILTER_SANITIZE_NUMBER_INT);
    $prizeSelect = mysqli_query($con, "SELECT Prize_ID,namePrize,numOfPrize,name_Event,nameSubEvent FROM ( (prize INNER JOIN event ON prize.event_ID = event.event_ID) INNER JOIN subevent ON subevent.event_ID = event.event_ID ) WHERE Prize_ID = '$prizeId' AND subevent.subevent_ID=prize.subevent_ID ");
    while ($row = mysqli_fetch_assoc($prizeSelect)) {
        $namePrize    = $row['namePrize'];
        $numOfPrize   = $row['numOfPrize'];
        $name_Event   = $row['name_Event'];
        $nameSubEvent = $row['nameSubEvent'];

    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>تفاصيل الجائزة </title>
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


</head>

<body>
    <div id="includedContent"></div>
    <div id="includedContent2"></div>
    <div class="mainContent">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panelTitle">تفاصيل الجائزة </h4>
                </div>
                <div class="panel-body">

                    <form action="" class="formDiv" method="post">

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="eventName" class="control-label"> اسم الحدث</label>
                                <label class="form-control" id="txtEventName" name="eventName">
                                    <?php echo $name_Event; ?></label>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="txtOrganizer" class="control-label">اسم الحدث الفرعي</label>
                                <label class="form-control" id="txtOrganizer" name="$subEventName">
                                    <?php echo $nameSubEvent; ?></label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="txtMaxAttendee" class="control-label"> اسم الجائزة </label>
                                <label class="form-control" id="txtEventName" name="prizeName">
                                    <?php echo $namePrize ?></label>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="txtLocation" class="control-label">عدد الجوائز</label>
                                <label class="form-control" id="txtLocation" name="prizeNum">
                                    <?php echo $numOfPrize ?></label>

                            </div>
                        </div>


                        <a href="/tactic/manageEvent.php" class="bodyform btn btn-nor-danger btn-sm">عودة</a>

                </form>

            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/appjs/event.js"></script>
    <script src="js/appjs/common.js"></script>

    <script>
        $(function () {
            $("#includedContent").load("php/TopNav.php");
            $("#includedContent2").load("HTML/rightNav.html");
        });
    </script>
</div>
</body>

</html>