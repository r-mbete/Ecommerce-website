<?php
require('connection.php');
$category=$_POST["category"];

$sql = "INSERT INTO tbl_categories(category_name)
VALUES ('$category')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  }
   else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>