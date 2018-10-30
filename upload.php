<?php

if($_FILES["fileToUpload"]["name"] != '')
{
 $test = $_FILES["fileToUpload"]["name"];
 $location = 'UploadFile/badges/123' . $test;  
 move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $location);
 echo '<img src="'.$location.'"  id="myImg"/>';
}
/*
.$eventID.$badgeType
    $badgeType =$_GET['badgeType'];
    $eventID =$_GET['eventID'];  */
?>
