<?php


$ini_array = parse_ini_file("config.ini", true);
//print_r($ini_array);

$dirpath = $ini_array["setup"]["folder_root"];
$extensions = $ini_array["setup"]["allowed_extensions"];
$maxSize = intval($ini_array["setup"]["max_size"]);



$file = basename($_GET['file']);
$file = $dirpath.$file;

if(!file_exists($file)){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($file);
}


?>
