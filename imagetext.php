<?php
// conect to database
require_once 'php/connectTosql.php';
// to enable write arabic letter in image
include 'phar://ArPHP.phar/Arabic.php';
// the image sourse to display in html
// test image
$sorce = "image/download.jpg";
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
putenv('GDFONTPATH=C:/xampp/htdocs/tactic/css/fonts');
$fontfile = 'C:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image in arabic
$Arabic = new I18N_Arabic('Glyphs');

$angle          = 0;
$attendeeID =$_GET["attendeeId"];

if ($attendeeID==0){
$visitorName    = $_GET["visitorName"];//position 
$visitorCareer  = $_GET["visitorCareer"];//position
$visitorBarcode = $_GET["visitorBarcode"];//position
$color          = $_GET["color"];
$barSize        = $_GET["barSize"];
$fontSize       = $_GET["fontSize"];
$imageName      = $_GET["sorce"];
$eventId        =$_GET["eventId"];
$visitorNameVal =$_SESSION['OrgName'];
$visitorCareerVal="منظم فعاليات";
$sorce = "image/" . $imageName;
}
else{
  $attende = mysqli_query($con, "SELECT *
  FROM ((attendee att INNER JOIN badge b ON att.eventId = b.event_ID)
    INNER JOIN imageinfo img ON img.badgeId = b.badge_ID)
    where att.id='$attendeeID ' ")
    or die(mysqli_error());
  
  
  while ($row = mysqli_fetch_array($attende)):
  $attendeeID=$row['attendee.id'];
  $visitorNameVal=$row['attendee.name'];
  $visitorCareerVal=$row['attendee.jobTitle'];
  $visitorName    = $row["imageinfo.namePosition"];//position 
  $myImg          = $_GET["myImg"];
  $visitorCareer  = $row["imageinfo.careerPosition"];
  $visitorBarcode = $row["imageinfo.barcodePosition"];
  $color          = $row["imageinfo.color"];
  $barSize        = $row["imageinfo.barSize"];
  $fontSize       = $row["imageinfo.fontSize"];
  $eventId= $row["badge.event_ID"];
  $imageName      = $attendeeID;
  $sorce =$row["badgeTemplateLocation"];
  endwhile; 
}



// convert barcode to image
$barcode = file_get_contents("https://chart.googleapis.com/chart?chs=$barSize&cht=qr&chl=$attendeeID&choe=UTF-8");
// save image in pc
file_put_contents('UploadFile/barcood/code.png', $barcode);
// Load And Create Image From Source this bacground image
$image = imagecreatefromjpeg($sorce);
// Load the stamp and the photo to apply the watermark to this barcode image
$stamp = imagecreatefrompng('UploadFile/barcood/code.png');
//the url of the result barcod.jpg
//$name="name.jpg";
$output = "UploadFile/".$eventId."/badge/". $imageName;



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

// attende Name
$leftName = calculateX($visitorName) ;
$topName  = calculateY($visitorName) ;

// Print Text On Image
imagettftext($image, $fontSize, $angle, $leftName+strlen("اسم الزائر") , $topName, $color, $fontfile, setText($Arabic, $visitorNameVal));

//attende Career

$leftCareer = calculateX($visitorCareer) ;
$topCareer  = calculateY($visitorCareer) ;

//Print Text On Image
imagettftext($image, $fontSize, $angle, $leftCareer-5, $topCareer, $color, $fontfile, setText($Arabic, $visitorCareerVal));

// attende Barcode

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right  = calculateX($visitorBarcode) ;
$marge_bottom = calculateY($visitorBarcode) ;
$stampx       = imagesx($stamp);
$stampy       = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo put two image togather
// width to calculate positioning of the stamp.
imagecopy($image, $stamp, $marge_right, $marge_bottom, 0, 0, $stampx, $stampy);

// Send Image to Browser
imagepng($image, $output);
echo json_encode($output);
?>