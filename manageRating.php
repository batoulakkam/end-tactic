<?php
// connect to DB
require_once 'php/connectTosql.php';
if (isset($_SESSION['organizerID'])) {
  $orgID     = $_SESSION['organizerID'];
  $query     = mysqli_query($con, "SELECT * FROM event WHERE organizer_ID = '$orgID'") or die(mysqli_error($con));
  $eventID   = "";
  $prizeName = "";
  $subName   = 0;
  if (isset($_POST['add'])) {
    $eventID    = $_POST['eventId']; // clear code this not acceptable
    $subeventId    = $_POST['SubEventName']==''? null:$_POST['SubEventName'];
if($eventID != 0 && $subeventId ==0 )
 header("location:rating.php?eID="."$eventID");
    else {
	header("location:rating.php?subID="."$subeventId");
    }
  }

}

?>




<!DOCTYPE html>
<html lang="ar">

<head>
  <title>إضافة تقييم </title>
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
          <h4 class="panelTitle"> إضافة تقييم </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDivAddPrize" method="post">

           <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                <select class="form-control" id="eventName" name="eventId" onChange="change_event()">
                <option value=""> اختيار </option >
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
                 <label for="SubEventName" class="control-label"> اسم الحدث الفرعي</label>
                <select class="form-control" id="SubEventName" name="SubEventName" >
                 <option value=""> اختيار </option >
                </select>
              </div>
            </div>

  

           <a  href="/tactic/anageRate.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
            <input type="submit" value="تقييم" name="add" class="btn btn-nor-primary btn-lg enable-overlay">


        </form>

      </div>
    </div>
  </div>
  </div>

<script>
   function change_event(){
 
   var  xmlhttp=new XMLHttpRequest();//
    xmlhttp.open("GET","addajaxsub.php?Eventname="+document.getElementById("eventName").value,false);
    xmlhttp.send(null);
    
    document.getElementById("SubEventName").innerHTML=xmlhttp.responseText;
   


    }

</script>

  <!-- end of  register inputs -->
        <script src="js/jquery.min.js"></script>
	    <script src="js/jquery.validate.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/appjs/prize.js"></script>
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