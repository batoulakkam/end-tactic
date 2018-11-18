<?php
// conect to database
require_once 'php/connectTosql.php';
// to enable write arabic letter in image
include 'phar://ArPHP.phar/Arabic.php';
// the image sourse to display in html
// test image
$source = "image/certificate.jpg";
// get the value of input

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

function setText($Arabic, $text)
{
 $text = $Arabic->utf8Glyphs($text);
 return $text;
}

// Set Path to Font File
putenv('GDFONTPATH=D:/xampp/htdocs/tactic/css/fonts');
$fontfile = 'D:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image in arabic
$Arabic = new I18N_Arabic('Glyphs');

$angle          = 0;
$attendeeID=$_POST["attendeeID"];

if ($attendeeID==0) {
$eventName    = $_POST["eventName"];
$visitorName  = $_POST["visitorName"];
$eventDate = $_POST["eventDate"];
$color          = $_POST["color"];
$fontSize       = $_POST["fontSize"];
$imageName      = $_POST["source"];
$eventNameVal = $_POST["lblEventNameVal"];
$visitorNameVal   = $_POST["lblVisitorNameVal"];
$eventDateVal = $_POST["lblEventDateVal"];
$eventId     = $_POST['eventId'];
$source = "image/" . $imageName;

if (!empty($_FILES["file"]["name"])) {

  $name     = $_FILES['file']['name'];
  $size     = $_FILES['file']['size'];
  $type     = $_FILES['file']['type'];
  $tmp_name = $_FILES['file']['tmp_name'];
  $location = "image/";

  $max_size = 1000000;
  if ($size <= $max_size) {
    // check the type of image
   if ($type == "image/jpg" || $type == "image/JPG" || $type == "image/jpeg" || $type == "image/JPEG") {
   move_uploaded_file($tmp_name, $source /*. $name*/);
   }
  }
}

 }
 //else {
//   $QueryAttende=mysqli_query($con, "SELECT *
// FROM ((attendee att INNER JOIN certificate ce ON att.eventId=ce.event_ID) INNER JOIN certificateimageinfo cer ON cer.certificateId=ce.certificate_ID) where att.id='$attendeeID '")
// or die(mysqli_error());
// while ($row = mysqli_fetch_array($QueryAttende)){

//  $visitorNameVal   = $row[2];
//  $eventNameVal = $row[1];
//  $eventDateVal= $row[3];

//  $eventName = $row[29];//position
//  $visitorName      = $row[28]; //position 
//  $eventDate    = $row[29]; //position

//  $color            = $row[24];
//  $fontSize          = $row[25];
//  $eventId          = $row[18]; //certificate.eventId
//  $imageName        = $attendeeID . ".jpg";
//  $source            = $row[22]; //certificate TemplateLocation
// }//end while
// }



// Load And Create Image From Source this bacground image
$image = imagecreatefromjpeg($source);
$output = "UploadFile/" . $eventId . "/certificate/" . $imageName;


// Allocate A Color For The Text Enter
switch ($color) {
 case "white":
  $color = imagecolorallocate($image, 255, 255, 255);
  break;
 case "red":
  $color = imagecolorallocate($image, 255, 0, 0);
  break;
 case "black":
  $color = imagecolorallocate($image, 0, 0, 0);
  break;
 default:
  $color = imagecolorallocate($image, 0, 0, 0);
}

// event Name
$leftEventName = calculateX($eventName) ;
$topEventName  = calculateY($eventName) ;

// Print Text On Image
imagettftext($image, $fontSize, $angle, $leftEventName + 105 - strlen($eventName), $topEventName  , $color, $fontfile, setText($Arabic, $eventNameVal));

// Visitor Name

$leftVisitorName = calculateX($visitorName) ;
$topVisitorName  = calculateY($visitorName);

//Print Text On Image
imagettftext($image, $fontSize, $angle, $leftVisitorName + 105 - strlen($visitorName), $topVisitorName  , $color, $fontfile, setText($Arabic, $visitorNameVal));


//event date

$leftEventDate = calculateX($eventDate) ;
$topEventDate  = calculateY($eventDate) ;

//Print Text On Image
imagettftext($image, $fontSize, $angle, $leftEventDate + 105 - strlen($eventDate), $topEventDate  , $color, $fontfile, setText($Arabic, $eventDateVal));

// Send Image to Browser
imagejpeg($image, $output);

// to send the source of image to position.js
echo '<img src="' . $output . '"  />';
?>

 <form method="post" action="" enctype="multipart/form-data" id="myform">
</form>