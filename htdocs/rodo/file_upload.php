<?php 
    include_once("file_parse.php");
    include_once("classes.php");
    include_once('functions.php');
    //session_start();
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }else{
        echo "<b> u r not logged, go away!</b>";
        header('Location: ' . "index.php", true, $permanent ? 301 : 302);
    }

    $mark_title = "";
    //$_POST["mark_name"]
    if(isset($_POST["mark_name"])){
        $mark_title = clean2($_POST["mark_name"]);
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
            //echo "something went wrong";
            //echo "<br>";
            echo $errors;
            //exit(1);
        }
        else {
            if ($errors != "") {
                echo $errors;
            }

            include_once("database_connection.php");

            $sql_insert = "INSERT INTO `grades`(`student_id`, `teacher_id`, `value`, `task`, `comment`, `expire_date`) VALUES ";

            //echo "exam name : ".$result->exam_name,"<br>";
            if($mark_title != ""){
                $result->exam_name = $mark_title;
            }

            foreach($result->students_results as &$data) {

                $student_id = "(SELECT id FROM students WHERE number = ".$data->index.")";
                $teacher_id = $user->id;
                $comment = $data->comments;

                $todays_date = date("Y-m-d");
                //increment 14 days
                $expire_date = strtotime($todays_date."+ 14 days");

                $value = str_replace(",", ".", $data->grade);
                if(strpos($value, "-")){
                    //minus
                    $comment = "(-) ".$comment;
                    $value = str_replace("-", "", $value);

                }
                if(strpos($value, "+")){
                    //plus
                    $comment = "(+) ".$comment;
                    $value = str_replace("+", "", $value);
                }

                $sql_insert = $sql_insert."(".$student_id.", ".$teacher_id.", ".$value.", '".$result->exam_name."', '".$comment."', '".$expire_date."')";
                //echo "index: $data->index<br>grade: $data->grade<br>comments: $data->comments<br>";
                //echo "<br>";
                $sql_insert = $sql_insert.",";
            }
            $sql_insert = substr($sql_insert, 0, strlen($sql_insert)-1); 
            $sql_insert = $sql_insert.";";
            //echo $sql_insert;

            $insert_result = $conn->query($sql_insert);
            //$insert_result = true;
            if(!$insert_result){
                echo "<hr>";
                echo "blad przy dodawaniu ocen, blad w pliku csv lub probowano dodac ocene dla studenta ktory nie ma konta<br />";
                echo $conn->error;
            }else{
                //success
                echo "success";
                //sleep(5);
                //header('Location: ' . "main_teacher.php", true, $permanent ? 301 : 302);
                //header( "Refresh:5; url='main_teacher.php'");

            }
        }
    }else{
        echo "error";
    }
?>