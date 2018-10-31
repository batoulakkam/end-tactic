<?php
// conect to database
require_once 'php/connectTosql.php';
// to enable write arabic letter in image
include 'phar://ArPHP.phar/Arabic.php'; 
// the image sourse to display in html 
// test image
$sorce="image/download.jpg";
// get the value of input  

$x_yposition = $_GET["x_yposition"];
$color=$_GET["color"];
$barSize=$_GET["barSize"];
$fontSize=$_GET["fontSize"];
$imageName=$_GET["sorce"];  


/*
$name     = $_FILES[$imageName]['name'];
$tmp_name = $_FILES[$imageName]['tmp_name'];
$location="UploadFile/badges/".$name;
move_uploaded_file($tmp_name, $location);
*/
//$imageName="i.jpg";
//$test=$sorce.name;

/*
$location="UploadFile/badges/".$sorce;
move_uploaded_file($tmp_name, $location);
*/
// this wrong i want url of image 
$sorce="image/".$imageName;
$sorce=$_GET["imgFullURL"];

$text="اسم الزائر";


 //test value for check the cood
 /*
$x_yposition="X228Y65";
$barSize="100x100";
$fontSize=10;
$color="";
*/

/*this part to sbustring the value of X & Y  from $x_yposition
(strpos) to get position of leaters  X & Y 
(substr)  to cut the numaric value for   X & Y 
*/
$yposition=strpos($x_yposition,"Y");
$xpostion=strpos($x_yposition,"X");
$left=substr($x_yposition,$xpostion+1,$yposition-1);
$top=substr($x_yposition,$yposition+1);
$angle=0;


$attendeeID=12345;
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
$output="UploadFile/testBadge/".$imageName;

//$output="UploadFile/testBadge/test.jpg";

// Allocate A Color For The Text Enter 
switch($color){
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

// Set Path to Font File
putenv('GDFONTPATH=C:/xampp/htdocs/tactic/css/fonts');
$fontfile ='C:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image in arabic 
$Arabic = new I18N_Arabic('Glyphs'); 
$text = $Arabic->utf8Glyphs($text); 



// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = $left;
$marge_bottom = $top;
$stampx = imagesx($stamp);
$stampy = imagesy($stamp);

$marge_bottom=$stampy + $top -3 ;	
// Print Text On Image
 imagettftext(  $image ,  $fontSize ,  $angle ,  $left,  $top ,  $color , $fontfile,  $text );
 // Copy the stamp image onto our photo using the margin offsets and the photo put two image togather
// width to calculate positioning of the stamp. 
imagecopy($image, $stamp,  $marge_right,   imagesy($image) - $marge_bottom  , 0, 0, imagesx($stamp), imagesy($stamp));

// Send Image to Browser 
imagepng($image,$output);

// to send the source of image to position.js
//echo json_encode($output);

echo '<img src="'.$output.'"  />';

?>
