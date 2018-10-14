
<?php
// conect to database
require_once 'php/connectTosql.php';
// to enable write arabic letter in image
include 'phar://ArPHP.phar/Arabic.php'; 

// convert barcode to image
$barcode = file_get_contents('https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=test&choe=UTF-8');
// save image in pc 
file_put_contents('image/code.png', $barcode);
// Load And Create Image From Source this bacground image
$image = imagecreatefromjpeg('image/bat.jpg');
// Load the stamp and the photo to apply the watermark to this barcode image 
$stamp = imagecreatefrompng('image/code.png');



$output="image/test.jpg";
$test="image/barcod.jpg";


// Allocate A Color For The Text Enter RGB Value
$white_color = imagecolorallocate($image, 255, 255, 255);

// Set Path to Font File
putenv('GDFONTPATH=C:/xampp/htdocs/tactic/css/fonts');
$fontfile ='C:/xampp/htdocs/tactic/css/fonts/arial.ttf';
// Set Text to Be Printed On Image

$Arabic = new I18N_Arabic('Glyphs'); 
$text = 'بسم الله الرحمن الرحيم'; 
$text = $Arabic->utf8Glyphs($text); 


$size=16;
$angle=0;
$left=12;
$top=20;

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 115;
$marge_bottom = 5;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

	
// Print Text On Image
 imagettftext(  $image ,  $size ,  $angle ,  $left,  $top ,  $white_color , $fontfile,  $text );
 // Copy the stamp image onto our photo using the margin offsets and the photo put two image togather
// width to calculate positioning of the stamp. 
imagecopy($image, $stamp, imagesx($image) - $sx - $marge_right,   imagesy($image) - $sy - $marge_bottom  , 0, 0, imagesx($stamp), imagesy($stamp));

// Send Image to Browser 
imagepng($image,$test);

?>



<html>
<html lang="ar">
<meta charset="utf-8">
<img src="<?php echo $test ;?>" >
</html>

