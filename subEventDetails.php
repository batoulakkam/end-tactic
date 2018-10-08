<?php
require_once 'php/connectTosql.php';

$query = null;
if (isset($_GET['subeventid']) && $_GET['subeventid'] != '') {
 $eventId = $_GET['subeventid'];
 $query   = mysqli_query($con, "SELECT * FROM subevent  WHERE subevent_ID ='$eventId' ") or die(mysqli_error($con));
 if ($query == null) {

 echo  "id is not exist";
 }
} else {
 header('Location: myerrorpage.php');
}
$return_arr = array();
$row        = null;
if ($query) {

 $row            = mysqli_fetch_row($query);
 $subevent_ID    = $row[0];
 $event_ID    = $row[1];
 $sname          = $row[2];
 $subdescription = $row[3];

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>تفاصيل حدث فرعي </title>
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
                    <h4 class="panelTitle">تفاصيل حدث فرعي </h4>
                </div>
                <div class="panel-body">

                    <form action="" class="formDiv" method="post">

                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="subEventName" class="control-label"> اسم الحدث الفرعي</label>
                                <label class="form-control" id="txtSubEventName" name="subEventName">
                                    <?php echo $sname  ?></label>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group form-group-lg">
                                <label for="txtSubEventDescription" class="control-label">وصف الحدث</label>
                                <label class="form-control" id="txtSubEventDescription" rows="3" name="subdescription">
                                    <?php echo $subdescription ?></label>
                            </div>
                        </div>

                        <a href="/tactic/manageSubEvent.php" class="bodyform btn btn-nor-danger btn-sm">عودة</a>
                </div>
                </form>

            </div>
        </div>
    </div>
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

</body>

</html>