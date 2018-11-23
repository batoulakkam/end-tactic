<?php
include 'connectTosql.php';
if (isset($_SESSION['organizerID'])) {
 $organizerid = $_SESSION['organizerID'];
 $curentdata  = date("Y-m-d");
 $query       = mysqli_query($con, "SELECT * FROM event where organizer_ID=  '$organizerid' AND endDate_Event>='$curentdata'  ") or die(mysqli_error());
 //name_Event

}
?>
  <link rel="stylesheet" href="css/main-rtl.css">
<div class ="headerNav">
               <nav class="navbar navbar-inverse"  data-offset-top="10" >

                <div class="container-fluid">


                  <ul class="nav navbar-nav"   >
                    <li ><a style ="color:white" href="Logout.php" ><?php if (isset($_SESSION["OrgName"])) {
 echo '<span class="glyphicon glyphicon-log-out"></span>    ';
 echo 'تسجيل الخروج';}
?></a></li>
                       <?php if (isset($_SESSION["OrgName"])) {
 echo '<li class="dropdown" ><a style ="color:white" href="LogIn.php" style="text-align: right" class="dropdown-toggle" data-toggle="dropdown" >';
}
?>&nbsp;  <span class="caret"> </span>
					  <?php
echo $_SESSION["OrgName"]; ?>
					  &nbsp; <?php
echo '<span class=" fa fa-user"></span></a>
                      <ul class="dropdown-menu" style="width: 300px;">
                        <li><a style="text-align: right" href="editPassword.php"><span class="fa fa-lock" style="padding-left: 15px"></span>تعديل كلمة المرور   </a></li>
                        <li class="divider"></li>
                        <li> <a href="editProfile.php" style="text-align: right;"><span class=" fa fa-user" style="padding-left: 10px"></span>تعديل المعلومات الشخصية  </a></li>

                      </ul>
                    </li>'; ?>

                    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span> تقدم الفعاليات </a>
        <ul class="dropdown-menu scrollable-menu" role="menu" style="width: 300px;">
          <?php
/*
 اذا كان الحدث لديه بطاقات و نموذج تسجيل يكون الون ازرق ولا يكزن احمر او برتقالي 
 (يكون احمر اذا لم يكن لديه الا واحد من (جوائز او حدث فرعي او شهادات  
 (يكون اللون اخضر اذا كان لديه بطاقات ونموذج تسجيل واثنين اما (جوائز  او شهادات او حدث فرعي  

*/

if (mysqli_num_rows($query) > 0) {
 while ($row = mysqli_fetch_array($query)):
  $eventName   = $row['name_Event'];
  $eventId     = $row['event_ID'];
  $progresMain = 0;
  $progres     = 0;
  $badge       = mysqli_query($con, "SELECT * FROM badge where event_ID= '$eventId' ") or die(mysqli_error());
  if (mysqli_num_rows($badge) > 0) {
   $progresMain = $progresMain+1;
  }

  $registrationForm = mysqli_query($con, "SELECT * FROM event WHERE eventLink != '' AND event_ID=  '$eventId'") or die(mysqli_error());
  if (mysqli_num_rows($registrationForm) > 0) {
   $progresMain = $progresMain +1;
  }

  $certificate = mysqli_query($con, "SELECT * FROM certificate WHERE event_ID= '$eventId'") or die(mysqli_error());
  if (mysqli_num_rows($certificate) > 0) {
   $progres = $progres +1;
  }

  $prize = mysqli_query($con, "SELECT * FROM prize WHERE event_ID= '$eventId'") or die(mysqli_error());
  if (mysqli_num_rows($prize) > 0) {
   $progres = $progres +1;
  }

  $subevent = mysqli_query($con, "SELECT * FROM subevent WHERE event_ID= '$eventId'") or die(mysqli_error());
  if (mysqli_num_rows($subevent) > 0) {
   $progres = $progres +1;
  }

  if ($progresMain >= 2) {
   $value = "info";
   if ($progres >= 2) {
    $value = "success";
   }

  } else {
   $value = "danger";
   if ($progres >= 2) {
    $value = "warning";
   }

   if ($progresMain == 1 && $progres == 1) {
    $value = "warning";
   }

  }

  $persentage = ($progres + $progresMain) * 16.6 + 17;
  echo "
	  <li>
			<a href='#'>
				<div>
					<p>
	        <span class='text-muted'>" . $persentage . "% </span>
						<strong class='pull-right '>" . $eventName. "</strong>
					</p>
					<div class='progress progress-striped active'>
						<div class='progress-bar progress-bar-" . $value . "' role='progressbar' aria-valuenow=" . $persentage . " aria-valuemin='0' aria-valuemax='100' style='width: " . $persentage . "%'>
							<span class='sr-only'>" . $persentage . "% (" . $value . ")</span>
						</div>
					</div>
				</div>
			</a>
	  </li>
	  <li class='divider'></li>
	  ";
 endwhile;
}

?>
        </ul>
      </li>
                  </ul>

                  <div class="navbar-header navbar-right  " >
                      <button class="navbar-brand titleNav fa fa-bars btn" onclick="toggleMenu()" style ="color:white"></button>
                     <a href="home.php"> <img src="image/logo.png" style="width: 30px;"/> </a>
                      <a class="navbar-brand titleNav" href="home.php" style ="color:cornflowerblue">تكتيك</a>
                    </div>
                </div>
              </nav>


    </div>
<div>