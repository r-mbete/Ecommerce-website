<?php

require('connection.php');

$first_name = $_POST["firstname"];
$last_name = $_POST["lastname"];
$gender = $_POST["gender"];
$number = $_POST["phone number"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "UPDATE tbl_users (first_name, last_name, gender, email, tel, email, password) 
SET ('$first_name', '$last_name', '$gender', '$number', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  }
   else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();


?>