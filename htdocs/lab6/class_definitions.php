<?php
class User{

public $login;
public $name;
public $level;

function set_name($login) {
    $this->login = $login;
}
function get_name() {
    return $this->login;
}

function load(){
    
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    //sanitize $this->login todo
    $this->login = $conn->real_escape_string($this->login);
    $sql = "SELECT * FROM lab6.users WHERE lab6.users.login = '".$this->login."';";
    //echo $sql;
    $b_found_user = false;
    if($result = $conn->query($sql)){
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row["id"];
            $this->level = $row["level"];
            $this->name = $row["name"];
            $b_found_user = true;
        } else {
            $b_found_user = false;
        }
    }
    
    $conn->close();
    return $b_found_user ;
}

}
class Content{
    public $pages = array();
}

class Page{
    public $id;
    public $title;
    public $content;
    public $level;
}
?>