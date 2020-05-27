<html >

<head>
<title>php file system</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- icons-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-dark text-light">
<div class="content">
<h2> php file manager</h2>

<?php
// Parse with sections
$ini_array = parse_ini_file("config.ini", true);
//print_r($ini_array);

$dirpath = $ini_array["setup"]["folder_root"];
$extensions = $ini_array["setup"]["allowed_extensions"];
$maxSize = intval($ini_array["setup"]["max_size"]);

//echo "debug: opening dir: $dirpath<br>";

echo "<hr>";

if($dir = @opendir($dirpath))
{
    
    echo '<table class="table table-dark"><thead>
            <tr>
                <th scope="col">icon</th>
                <th scope="col">file name</th>
                <th scope="col">file size</th>
                <th scope="col">delete file</th>
            </tr>
            </thead>
            <tbody>';
    while($file = readdir($dir))
    {
        if($file === "." || $file === ".." || is_dir($dirpath.$file))continue;

        //$x = $dirpath.$file;

        //echo "$x";
        echo '<tr>';

        $fsize = 0;
        $fsize = filesize($dirpath.$file);
        $fsize = $fsize / 1024;

        $fileExtension = strtolower(pathinfo($dirpath.$file,PATHINFO_EXTENSION));
        
        //echo "<td><img src=\"img/$fileExtension.png\" alt=\"img/$fileExtension.png\"></td>";
        //echo "<td><span class=\"file-type-icon text-center text-uppercase font-weight-bold align-middle badge badge-pill badge-primary\">$fileExtension</span></td>";
        echo '<td><i class="fa ';

        if($fileExtension == "zip" || $fileExtension == "rar" || $fileExtension == "7z"){
            echo 'fa-file-archive-o';
        }else
        if($fileExtension == "mp3" || $fileExtension == "wma" || $fileExtension == "wav" || $fileExtension == "flac"){
            echo 'fa-file-audio-o';
        }else
        if($fileExtension == "txt" || $fileExtension == "php" || $fileExtension == "jar" || $fileExtension == "py"|| $fileExtension == "c" || $fileExtension == "cs" || $fileExtension == "cpp"){
            echo 'fa fa-file-code-o';
        }else
        if($fileExtension == "jpg" || 
        $fileExtension == "png" || 
        $fileExtension == "bmp" || 
        $fileExtension == "jpeg"|| 
        $fileExtension == "gif"){
            echo 'fa fa-file-image-o';
        }else
        if($fileExtension == "mp4" || 
        $fileExtension == "avi"|| 
        $fileExtension == "mkv" || 
        $fileExtension == "wmv"){
            echo 'fa fa-file-movie-o';
        }else
        if($fileExtension == "pdf"){
            echo 'fa fa-file-pdf-o';
        }else
        if($fileExtension == "ppx"){
            echo 'fa fa-file-powerpoint-o';
        }else{
            echo 'fa fa-file-powerpoint-o';
        }

        

        echo '" style="font-size:2em;color:white"></i></td>';
        
        
        echo "<td><a href=\"download.php?file=$file\">$file</a></td>";
        echo "<td>";
        echo number_format($fsize, 2);
        echo " Kb</td>";
        //echo '<td><button type="button" class="btn btn-primary">download</button></td>';
        //<a href=\"delete.php?file=$file\" class=\"btn btn-danger\">delete</a>
        echo "<td><a href=\"delete.php?file=$file\" class=\"btn btn-danger btn-block\"><i class=\"fa fa fa-trash\" style=\"font-size:1em;color:white\"></i></a></td>";
        
        
        echo '</tr>';
    }


    echo '</tbody></table>';

    closedir($dir);
}else
{
    echo "error, cant open dir";
}

?>


<hr>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload file" name="submit">
</form>
</div>
</body>
</html>