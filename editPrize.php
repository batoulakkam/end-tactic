<?php
require_once 'php/connectTosql.php';

   if (isset($_SESSION['emailconfirm']) and $_SESSION['emailconfirm'] == 1) {
    $organizerid=$_SESSION['organizerID'];
      //this section for get the event name fro DB
           $query = mysqli_query($con,"SELECT * FROM event where organizer_ID=  '$organizerid'")or die(mysqli_error($con));

            if(isset($_POST['update']) ){
              ///// chech the spelling of $subID
                $prizeId = $_GET['prizeId'];
                $subeEventName =$_POST['subEventName'];
                $eventID = $_POST["eventName"];
                $prizeName = $_POST['prizeName'];
                $numOfPrize = $_POST['prizeNum'];
                
		
              $sql = mysqli_query($con, " UPDATE prize SET namePrize='$prizeName' ,numOfPrize ='$numOfPrize' , event_ID = '$eventID' , subevent_ID='$subeEventName' 
              WHERE Prize_ID ='$prizeId'")or die(mysqli_error($con));
            if($sql)

            
            if($sql)
                 header("location: /tactic/mangePrize.php");
                      else{
                    echo " <div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong> فشل</strong>   عملية التعديل  يرجى التحقق
              </div> ";
                } 
            } //end if (isset($_POST['update']) )
     } else {
      echo " <div class='alert alert-danger alert-dismissible'>
             <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong> يرجى</strong>   تثبيت الايميل لكي تتمكن من أضافة حدث
            </div> ";
     }

     $queryprize = null;
     if (isset($_GET['prizeId']) && $_GET['prizeId'] != '') {
      $prizeId = $_GET['prizeId'];
      $queryprize   = mysqli_query($con, "SELECT * FROM prize  WHERE prize_ID ='$prizeId' ") or die(mysqli_error($con));
      if ($queryprize == null) {
     //TODO
       //show hime error message to tell him that the id is not exist
      }
     } else {
      // TODO
      //you shouls redirect him to error page
     }
     
     $return_arr = array();
     $row        = null;
     if ($queryprize) {
     
      $row              = mysqli_fetch_row($queryprize);
      $prizeID          = $row[0];
      $namePrize        = $row[1];
      $numOfPrize       = $row[2];
      $eventID         = $row[3];
      $subEventID      = $row[4];
     
     }
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <title>تعديل الجائزة </title>
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
          <h4 class="panelTitle"> تعديل الجائزة  </h4>
        </div>
        <div class="panel-body">

          <form action="" class="formDiv" method="post">

            <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الحدث</label>
                <select class="form-control" id="eventName" name="eventName" >
                <option value="">اختيار </option>
                    <?php
                  
                  while ($row = mysqli_fetch_array($query)):
                    if ($eventID  == $row['event_ID'] ) {
                   
                  echo "<option value='" . $row['event_ID'] . "'  selected='selected' >" . $row['name_Event'] . "</option>";}
                 else
                 echo "<option value='" . $row['event_ID'] . "' >" . $row['name_Event'] . "</option>";
                 ?>
                 <?php endwhile;?>
                </select>
              </div>
            </div>

             <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label for="eventName" class="control-label">   اسم الحدث الفرعي </label>
                <select class="form-control" id="SubEventName" name="SubEventName" >
                
                </select>
              </div>
            </div>
             <div class="col-md-12">
                <div class="form-group form-group-lg">
                <label for="eventName" class="control-label"> اسم الجائزة</label>
                <input type="text" class="form-control" id="prizeName"  name="prizeName" value="<?php echo $namePrize ?>" required>
              </div>
            </div>

               <div class="col-md-12">
              <div class="form-group form-group-lg">
                   <label for="txtMaxAttendee" class="control-label"> عدد الجوائز</label>
                 <input type="number" class="form-control" id="txtSubEventName"  name="prizeNum" value = "<?php echo $numOfPrize ?>" required>
                  </div>
                 </div>

           <a  href="/tactic/manageSubEvent.php"  class="bodyform btn btn-nor-danger btn-sm">رجوع</a>
            <input type="submit" value="تعديل" name="update" class="btn btn-nor-primary btn-lg enable-overlay">

        
           
        </form>

      </div>
    </div>
  </div>
    
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>
    $(document).ready (function (){
 
   var  xmlhttp=new XMLHttpRequest();//
    xmlhttp.open("GET","ajax.php?subeEventId=$subeEventName  &Eventname="+document.getElementById("eventName").value,false);
    xmlhttp.send(null);
    
    document.getElementById("SubEventName").innerHTML=xmlhttp.responseText;
    });

</script>
  <!-- end of  register inputs -->
 <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
  // this part for call navBar
    $(function () {
      $("#includedContent").load("php/TopNav.php");
      $("#includedContent2").load("HTML/rightNav.html");
    });
  </script> 

    

</div>
</body>
</html>
