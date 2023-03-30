<?php

require('connection.php');
session_start();

$first_name = $_POST["firstname"];
$last_name = $_POST["lastname"];
$gender = $_POST["gender"];
$number = $_POST["number"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO tbl_users (first_name, last_name, gender, tel_number, email, password) 
VALUES ('$first_name', '$last_name', '$gender', '$number', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
  header('location:login.php');
  }
   else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }


$conn->close();
?>