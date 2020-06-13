<?php
    include_once('functions.php');
    if (isset($_POST) && isset($_POST["user_type"]) && isset($_POST["login"]) && isset($_POST["old_password"]) && isset($_POST["new_password"])) {
        $connection = new mysqli("localhost", "root", "");
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
            $response_array["response"] = 'Database connection error. Please try again later.';
            $response_array["success"] = "false";
            echo json_encode($response_array);
            exit(1);
        }

        $query = "select * from ";
        $table_name = "";
        $name_field = "";
        if ($_POST["user_type"] == "student") {
            $table_name = "students";
            $name_field = "number";
        } else if ($_POST["user_type"] == "teacher") {
            $table_name = "teachers";
            $name_field = "login";
        } else {
            $response_array["response"] = "Wrong user type";
            $response_array["success"] = "false";
            echo json_encode($response_array);
            exit(1);
        }
        $login = $_POST["login"];
        $old_pass = $_POST["old_password"];
        $old_pass = encryptPassword($old_pass);
        $query = $query . $table_name . " where $name_field like '$login' and password like '$old_pass';";
        $result = $connection->query($query);
        if (!$result || $result->num_rows <= 0) {
            $response_array["response"] = "Wrong password supplied! No user with that password found. Supply valid one!";
            $response_array["success"] = "false";
            echo json_encode($response_array);
            exit(1);
        }

        $new_pass = $_POST["new_password"];
        $new_pass = encryptPassword($new_pass);
        $update_query = "update " . $table_name . " set password = '$new_pass' where $name_field like '$login' and password like '$old_pass';";
        $connection->query($update_query);
        if (mysqli_affected_rows($connection) == 1) {
            $response_array["response"] = "Password changed successfully!";
            $response_array["success"] = "true";
            echo json_encode($response_array);
        } else {
            $response_array["response"] = "Nothing has changed.";
            $response_array["success"] = "false";
            echo json_encode($response_array);
        }
    } else {
        $response_array["status"] = "error";
        echo json_encode($response_array);
    }
?>