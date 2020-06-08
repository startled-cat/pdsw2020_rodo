<?php
include_once("database_connection.php");


$sql = "SELECT * FROM rodo.v_students_grades";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: ". $row["id"]."; student_id: " . $row["student_id"]."; student_number: " . $row["student_number"]. " teacher_id: " . $row["teacher_id"]. " teacher_name: " . $row["teacher_name"]. " ; value: " . $row["value"]. " ; task: " . $row["task"]." ; comment: " . $row["comment"]." ; date: " . $row["date"]." ; expire_date: " . $row["expire_date"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();


?>