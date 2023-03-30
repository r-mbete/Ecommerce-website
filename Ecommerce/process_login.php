<?php

require("connection.php");
session_start();

if (isset($_POST['login'])) {
    

    $email=$_POST['user_email'];
    
    
    $pass=$_POST['pass'];

    
    $sqlusers="SELECT * FROM tbl_users WHERE email='$email' && password='$pass'";

$query= mysqli_query($conn,$sqlusers);


if (mysqli_num_rows($query) > 0) {

   $row= mysqli_fetch_array($query);

    if($row['email'] == 'ruby.mbete@gmail.com'){

        $_SESSION['admin_name']= $row['first_name'];
        header('location:admin.php');

    }
    else
    {
        $_SESSION['user_name']= $row['first_name'];
        header('location:index.php');

   
   }

   
    }
    
    else
    {
      Echo"Incorrect email or password";  
    }

    
    
};




?>