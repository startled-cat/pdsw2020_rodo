<?php 
    include_once("file_parse.php");
    include_once("classes.php");

    if (isset($_POST["submit"])) {
        $file_name = $_FILES["filename"]["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($extension != "csv") {
            echo "only csv files are supported try again";
            exit(1);
        }
        $errors = "";
        $result = parse_csv_file($_FILES["filename"]["tmp_name"], $errors);
        if ($result == false) {
            echo "something went wrong";
            echo "<br>";
            echo $errors;
            exit(1);
        }
        else {
            if ($errors != "") {
                echo $errors;
            }
            foreach($result->students_results as &$data) {
                echo "index: $data->index<br>grade: $data->grade<br>comments: $data->comments<br>";
                echo "<br>";
            }
        }
    }
?>