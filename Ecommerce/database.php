<?php
require('connection.php');

$sql="SELECT instructorid, instructorfname, instructorlname FROM instructor";
$result = $conn->query($sql);
$row= $result->fetch_assoc();
//if ($result->num_rows > 0) {
    // output data of each row
    //while($row = $result->fetch_assoc()) {
      //echo "id: " . $row["category_id"]. " - Name: " . $row[""]. " " . $row["lastname"]. "<br>";
    //}
  //} else {
    //echo "0 results";
  //}
  echo '<pre>';
  print_r($row);
  echo '</pre>';
  $conn->close();
?>