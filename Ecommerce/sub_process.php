<?php
require('connection.php');
$subcategory=$_POST["subcategory"];

$sql = "INSERT INTO tbl_subcategories(subcategory_name)
VALUES ('$subcategory')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  }
   else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>