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
putenv('GDFONTPATH=D:/xampp/htdocs/tactic/css/fonts');
$fontfile = 'D:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image in arabic
$Arabic = new I18N_Arabic('Glyphs');

$angle          = 0;
$visitorName    = $_GET["visitorName"];
$myImg          = $_GET["myImg"];
$visitorCareer  = $_GET["visitorCareer"];
$visitorBarcode = $_GET["visitorBarcode"];
$width          = $_GET["width"];
$height         = $_GET["height"];
$color          = $_GET["color"];
$barSize        = $_GET["barSize"];
$fontSize       = $_GET["fontSize"];
$imageName      = $_GET["sorce"];

$visitorCareerVal = $_GET["lblvisittorNameVal"];
$visitorNameVal   = $_GET["lblvisittorCareerVal"];

// this wrong i want url of image
$sorce = "image/" . $imageName;

$text = "اسم الزائر";

$attendeeID = 12345;
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
$output = "UploadFile/testBadge/" . $imageName;

//$output="UploadFile/testBadge/test.jpg";

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

$imagePositionX = calculateX($myImg);
$imagePositionY = calculateY($myImg);

// attende Name
$leftName = calculateX($visitorName) - $imagePositionX;
$topName  = calculateY($visitorName) - $imagePositionY;

// Print Text On Image
imagettftext($image, $fontSize, $angle, $leftName - 5, $topName, $color, $fontfile, setText($Arabic, $visitorCareerVal));

//attende Career

$leftCareer = calculateX($visitorCareer) - $imagePositionX;
$topCareer  = calculateY($visitorCareer) - $imagePositionY;

//Print Text On Image
imagettftext($image, $fontSize, $angle, $leftCareer, $topCareer, $color, $fontfile, setText($Arabic, $visitorNameVal));

// attende Barcode

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right  = calculateX($visitorBarcode) - $imagePositionX;
$marge_bottom = calculateY($visitorBarcode) - $imagePositionY;
$stampx       = imagesx($stamp);
$stampy       = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo put two image togather
// width to calculate positioning of the stamp.
imagecopy($image, $stamp, $marge_right, $marge_bottom, 0, 0, $stampx, $stampy);

// Send Image to Browser
imagepng($image, $output);
// to send the source of image to position.js
//echo json_encode($output);
echo '<img src="' . $output . '"  />';
