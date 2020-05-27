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
    //delettt
    $file = realpath($file);
    if(is_writable($file)){
        unlink($file);
        $permanent = True;
        header('Location: ' . "index.php", true, $permanent ? 301 : 302);
    }else{
        echo 'cannot delete file :(';
        echo '<br /><a href="index.php"> Go back</a>';
    }
}


?>
