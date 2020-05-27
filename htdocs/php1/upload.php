<html>
<?php

// Parse with sections
$ini_array = parse_ini_file("config.ini", true);
//print_r($ini_array);

$dirpath = $ini_array["setup"]["folder_root"];
$extensions = $ini_array["setup"]["allowed_extensions"];
$maxSize = intval($ini_array["setup"]["max_size"]);



$target_file = $dirpath . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])){
    //check extension fileExtension

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > $maxSize) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if(!strpos($extensions, $fileExtension)) {
        echo "Sorry, only $extensions files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<hr>Sorry, your file was not uploaded.";
        echo '<br /><a href="index.php"> Go back</a>';
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

            $permanent = True;
            header('Location: ' . "index.php", true, $permanent ? 301 : 302);

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

echo "";
?>
</html>