<?php 
    include_once("classes.php");
    
    //session_start();
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }else{
        echo "<b> u r not logged, go away!</b>";
        header('Location: ' . "index.php", true, $permanent ? 301 : 302);
    }


    $msg = "";
    //$_POST["mark_name"]
    if(isset($_POST["message-text"])){
        $msg = $_POST["message-text"];
        $sql_insert = "INSERT INTO `bugs` (`author_id`, `text`) VALUES (".$user->id.",'".$msg."')";//todo: sql injection
        //echo $sql_insert;
        include_once("database_connection.php");
        $insert_result = $conn->query($sql_insert);
        //$delete_result = true;
        if(!$insert_result){
            echo "error while trying to send bug report ";
        }else{
            echo "successfully reported bug ";
            //header('Location: ' . "index.php", true, $permanent ? 301 : 302);
        }
    }else{
        //echo '   <br>isset($_POST["message-text"]) is false';
        
    }
    //header('Location: ' . "index.php", true, $permanent ? 301 : 302);
?>