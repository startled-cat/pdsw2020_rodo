<?php

class User{

    public $login;
    public $name;
    public $id;
    //public $level;

    public $is_student = false;

    public $is_teacher = false;

    function set_login($login) {
        $this->login = $login;
    }
    function get_login() {
        return $this->login;
    }

    function login_as_student($password){
        //echo ' passform = '.$password;
        
        include 'database_connection.php';
        //echo "Connected successfully";
        //sanitize $this->login todo
        $this->login = $conn->real_escape_string($this->login);
        $sql = "SELECT * FROM rodo.students WHERE rodo.students.number = '".$this->login."';";
        //echo $sql;
        $b_found_user = false;
        if($result = $conn->query($sql)){
            if ($result->num_rows == 1) {
                $b_found_user = true;
                $row = $result->fetch_assoc();
                //echo ' passsql = '.$row["password"];
                
                if($password == $row["password"]){
                    $is_student = true;
                    $this->id = $row["id"];
                    $this->name = $row["number"];
                }else{
                    $b_found_user = false;
                }
                // }else{
                //     echo "wrong password!";
                // }
            } else {
                $b_found_user = false;
            }
        }
        
        $conn->close();
        return $b_found_user;
    }

    function login_as_teacher($password){
        
        
        include 'database_connection.php';
        //echo "Connected successfully";
        //sanitize $this->login todo
        $this->login = $conn->real_escape_string($this->login);
        $sql = "SELECT * FROM rodo.teachers WHERE rodo.teachers.login = '".$this->login."';";
        //echo $sql;
        $b_found_user = false;
        if($result = $conn->query($sql)){
            if ($result->num_rows == 1) {
                $b_found_user = true;
                $row = $result->fetch_assoc();
                if($password == $row["password"]){
                    $is_teacher = true;
                    $this->id = $row["id"];
                    $this->level = $row["level"];
                    $this->name = $row["display_name"];
                }
                // }else{
                //     echo "wrong password!";
                // }
            } else {
                $b_found_user = false;
            }
        }
        
        $conn->close();
        return $b_found_user ;
    }
}

?>
