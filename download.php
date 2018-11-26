<?php


if (!empty($_GET['file'])) {
    // Security, down allow to pass ANY PATH in your server
    $fileName = str_replace("UploadFile/","",$_GET['file']); 
} else {
    return;
}

$filePath = 'UploadFile/'.$fileName;
if (!file_exists($filePath)) {
    return;
}

header("Content-disposition: attachment; filename=" . $fileName);
readfile($filePath);
?>