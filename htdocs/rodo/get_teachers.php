<?php
include_once("database_connection.php");


$sql = "SELECT * FROM rodo.teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - login: " . $row["login"]. " ; password: " . $row["password"]. " ; display_name: " . $row["display_name"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();


?>