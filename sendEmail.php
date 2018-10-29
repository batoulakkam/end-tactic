<?php
// conect to database 
require_once('php/connectTosql.php');
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");
$attendeeID    = '';
$email_Att[]   = "";
$masg          = "";
$mail          = new PHPMailer\PHPMailer\PHPMailer();
$mail          = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth   = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host       = "smtp.gmail.com";
$mail->Port       = 587; // or 587
$mail->IsHTML(true);
$mail->Username = 'tactic.gp@gmail.com';
$mail->Password = '1234567890Qw';
$mail->setfrom('tactic.gp@gmail.com', 'tactic');
//////////////////////////////////////////////////////////////
if (isset($_GET['event_ID'])) {
    $event_ID = $_GET['event_ID'];
    $query = mysqli_query($con, "SELECT * FROM event WHERE event_ID = '$event_ID' ") or die(mysqli_error($con));
    $rows      = mysqli_fetch_array($query);
    $eventName = $rows['name_Event'];
    $eventDate = $rows['sartDate_Event'];
    if (isset($_GET['all']))
        $sql = mysqli_query($con, "SELECT * FROM attendee WHERE event_ID = '$event_ID' ") or die(mysqli_error($con));
    elseif (isset($_GET['VIP']))
        $sql = mysqli_query($con, "SELECT * FROM attendee WHERE event_ID = '$event_ID'AND VIP_code !=0") or die(mysqli_error($con));
    elseif (isset($_GET['normal'])) {
        $sql = mysqli_query($con, "SELECT * FROM attendee WHERE event_ID = '$event_ID' AND VIP_code = 0 ") or die(mysqli_error($con));
    } //isset($_GET['normal'])
} //isset($_GET['event_ID'])
if ($sql) {
    $x = 0;
    while ($row = mysqli_fetch_array($sql)) {
        $email_Att[$x] = $row['email_Att'];
        $mail->AddAddress($row['email_Att']);
        $name[$x] = $row['name_Att'];
        echo $name[$x];
        $mensaje = file_get_contents('emailTemplate.html');
        $mensaje = str_replace("{{USERNAME}}", $name[$x], $mensaje);
        $mensaje = str_replace("{{eventName}}", $eventName, $mensaje);
        $mensaje = str_replace("{{eventDate}}", $eventDate, $mensaje);
        $x++;
        if (isset($_POST['submit'])) {
            $subject = $_POST['subject'];
            $body    = $_POST['message'];
            if (isset($_POST['logo']))
                $logo = $_POST['logo'];
            $mail->Subject = $subject;
            $mensaje       = str_replace("{{subject}}", $body, $mensaje);
            $mensaje       = str_replace("{{eventLogo}}", $logo, $mensaje);
            $mail->Body    = $mensaje;
            if (!$mail->send()) {
                $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong>  غير متوقع ! فضلا حاول مرة اخرى.
       </div> ";
            } //!$mail->send()
        } //isset($_POST['submit'])
    } //$row = mysqli_fetch_array($sql)
} //$sql
?>
<!DOCTYPE html>
<html>
   <head>
      <title>ارسال بريد الكتروني </title>
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
      <link rel="shortcut icon" href="image/tacticLogo.png" type="image/x-icon" />
   </head>
   <body>
      <div id="includedContent"></div>
      <div id="includedContent2"></div>
      <div class="mainContent">
         <div class="container">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h4 class="panelTitle">   ارسال بريد الكتروني  :<?php echo $eventName; ?></h4>
               </div>
               <div class="panel-body">
                  <form action="" class="formDiv" method="post"autocomplete="on">
                     <?php  if ($masg !="") echo $masg."<br>"; ?>
                     <div class="col-md-12">
                        <div class="form-group form-group-lg">
                           <label for="eventName" class="control-label">المستقبل : </label> 
                           <?php $value="";
                              if(isset($_GET['all']))
                              $value = 'ارسال للجميع';
                              elseif (isset($_GET['VIP']))
                              $value ='ارسال للاشخاص المهمين';
                              else $value='ارسال للاشخاص العاديين'; ?>
                           <input type="text"  class="form-control" value="<?PHP echo $value; ?>" disabled />
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group form-group-lg">
                           <label class="control-label"> الموضوع : </label>
                           <input type="text" class="form-control" id="email" name="subject"  >
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group form-group-lg">
                           <label class="control-label"> اختار شعار الفعالية :</label> <br><br>
                           <label  class="btn-primary btn" for="files"  style="width:100; float:right;" > ارفع الملف</label>
                           <input type="file" name= "logo"  id="files"  style="visibility:hidden;" >&nbsp; <span  id="fileC" for= "files"> لم اختيار الملف</span>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group form-group-lg">
                           <label  class="control-label">نص الرسالة  :</label>  
                           <textarea  name="message"  class="form-control" rows="10"  ></textarea>
                        </div>
                     </div>
                     <a  href=""  class="bodyform btn btn-nor-danger btn-sm">عودة</a>
                     <input type="submit" value="إرسال" name="submit" class="btn btn-nor-primary btn-lg enable-overlay">
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
            $("#files").change(function() {
            filename = this.files[0].name
            console.log(filename);
            });
            
            $("#files").change(function() {
            $("#fileC").empty();
            $("#fileC").append(filename = this.files[0].name);
            });
         </script>
      </div>
   </body>
</html>