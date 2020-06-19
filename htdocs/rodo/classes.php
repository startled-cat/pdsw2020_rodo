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
        
        include_once('functions.php');
        //echo "Connected successfully";
        //sanitize $this->login todo
        #$this->login = $conn->real_escape_string($this->login);
        $this->login = clear($conn, $this->login);
        $sql = "SELECT * FROM students WHERE students.number = '".$this->login."';";
        //echo $sql;
        //exit(1);
        if($result = $conn->query($sql)){
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                //echo ' passsql = '.$row["password"];
                
                if(encryptPassword($password) == $row["password"]){
                    $is_student = true;
                    $this->id = $row["id"];
                    $this->name = $row["number"];
                }else{
                    return "wrong password!";
                }

                $today = date("Y-m-d");
                if ($row['expire_date'] != NULL && $row['expire_date'] < $today) {
                    //error, expired
                    return "account has expired! (".$row['expire_date'].")";
                }

            } else {
                return "could not find user";
            }
        }
        
        $conn->close();
        return "";
    }

    function login_as_teacher($password){
        
        
        include 'database_connection.php';
        include_once('functions.php');
        //echo "Connected successfully";
        //sanitize $this->login todo
        #$this->login = $conn->real_escape_string($this->login);
        $this->login = clear($conn, $this->login);
        $sql = "SELECT * FROM teachers WHERE teachers.login = '".$this->login."';";
        //echo $sql;
        if($result = $conn->query($sql)){
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if(encryptPassword($password) == $row["password"]){
                    $is_teacher = true;
                    $this->id = $row["id"];
                    $this->name = $row["display_name"];
                //}
                }else{
                    return "wrong password!";
                }
            } else {
                return "could not find user";
            }
        }
        
        $conn->close();
        return "" ;
    }
}

class CsvFileData {
    public $exam_name;
    public $students_results;

    function __construct($ex_name) {
        $this->exam_name = $ex_name;
        $this->students_results = array();
    }

    function add_student_exam_data($data) {
        array_push($this->students_results, $data);
    }
}

class StudentExamData {
    public $index;
    public $exam_name;
    public $grade;
    public $comments;

    function __construct($index_nr, $ex_name, $student_grade, $grade_comments) {
        $this->index = $index_nr;
        $this->exam_name = $ex_name;
        $this->grade = $student_grade;
        $this->comments = $grade_comments;
    }
}

?>
