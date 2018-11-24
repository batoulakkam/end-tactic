<?php
// conect to database
require_once 'php/connectTosql.php';
// to enable write arabic letter in image
include 'phar://ArPHP.phar/Arabic.php';

// the image sourse to display in html

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
putenv('GDFONTPATH=C:/xampp/htdocs/tactic/css/fonts');
$fontfile = 'C:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image in arabic
$Arabic = new I18N_Arabic('Glyphs');

$angle          = 0;
$attendeeID=$_GET["attendeeID"];
$QueryAttende= mysqli_query($con, "SELECT *
  FROM ((certificate ce INNER JOIN certificateimageinfo img ON img.certificateId=ce.certificate_ID)
    INNER JOIN attendee att ON att.eventId=ce.event_ID)
    where att.id='$attendeeID' ") or die(mysqli_error($con));


 while ($row = mysqli_fetch_array($QueryAttende)){
   $certificateId=$row[0];
  $eventId     = $row[1];
  $eventName    = $row[10];//postion
  $visitorName  = $row[11];//postion
  $eventDate = $row[12];//postion
  $color          = $row[7];
  $fontSize       = $row[8];
  $visitorNameVal   = $row[16];
  $source =$row[5];
  $type=$row[4];
  $extention=substr($type,6);
  $imageName      = $attendeeID.".".$extention;

  $query2     = mysqli_query($con, "SELECT * FROM event WHERE event_ID = '$eventId'");
  while ($row = mysqli_fetch_array($query2)) {
    $eventNameVal = $row[1];
    $eventDateVal = $row[3];
} //$row
 }//end while
// Load And Create Image From Source this bacground image
$image = imagecreatefromjpeg($source);
$output = 'UploadFile/'.$eventId.'/certificate/'.$imageName;
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
if ($attendeeID!=0){
  true;
}
// to send the source of image to position.js

?>


