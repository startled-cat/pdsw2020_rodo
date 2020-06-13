<?php
$sql_servername = "localhost";
$sql_username = "root";
$sql_password = "";

// Create connection
$conn = new mysqli($sql_servername, $sql_username, $sql_password);

// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully ";
?>