<?php 
    include_once("classes.php");
    
    session_start();
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }else{
        echo "<b> u r not logged, go away!</b>";
        header('Location: ' . "index.php", true, $permanent ? 301 : 302);
    }


    $task_title = "";
    //$_POST["mark_name"]
    if(isset($_POST["task_to_delete"])){
        $task_title = $_POST["task_to_delete"];
        //echo ' will deelte all grades from task : '.$task_title;
        $sql_delete = "DELETE FROM grades WHERE task = '".$task_title."';";
        //echo $sql_delete;
        include_once("database_connection.php");
        $delete_result = $conn->query($sql_delete);
        //$delete_result = true;
        if(!$delete_result){
            echo "error while tryign to delete grades ";
        }else{
            echo "successfulyl deleted grades ";
        }
    }else{
        
    }
?>