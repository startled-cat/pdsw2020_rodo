<?php
include_once("database_connection.php");

$sql = "SELECT * FROM rodo.students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - number: " . $row["number"]. " ; password" . $row["password"]. " ; expire_date" . $row["expire_date"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();


?>