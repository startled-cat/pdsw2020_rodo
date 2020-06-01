<?php 
    include_once("file_parse.php");
    include_once("classes.php");
    //session_start();
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }else{
        echo "<b> u r not logged, go away!</b>";
        header('Location: ' . "index.php", true, $permanent ? 301 : 302);

        //redirect to index?
    }

    $table = "";
    $mark_title = "";
    //$_POST["mark_name"]
    if(isset($_POST["mark_name"])){
        $mark_title = $_POST["mark_name"];
    }

    

    if (isset($_FILES) && isset($_POST) && isset($_FILES["fileToUpload"])) {
        $file_name = $_FILES["fileToUpload"]["name"];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($extension != "csv") {
            echo "only csv files are supported try again";
            exit(1);
        }
        $errors = "";
        $result = parse_csv_file($_FILES["fileToUpload"]["tmp_name"], $errors);
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
            $table = "<table class=\"table table-striped\">
            <thead>
              <tr>
                <th scope=\"col\">Index</th>
                <th scope=\"col\">Mark</th>
                <th scope=\"col\">Comment</th>
              </tr>
            </thead>
            <tbody>";
            foreach($result->students_results as &$data) {

              $table = $table."<tr>
                <th scope=\"row\">$data->index</th>
                <td>$data->grade</td>
                <td>$data->comments</td>
                </tr>";

            }
            $table = $table."</tbody>
            </table>";
            
        }
    }else{
        echo "error";
    }
?>