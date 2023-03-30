<html>

<head>
    <title>Login</title>
    <style>
    body {
        background-color: #dbcaca;
        font-family: poppins;
    }
    </style>
</head>
<link rel="stylesheet" type="text/css" href="styl.css">



<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">


<body class=body>
    <div class="loginbox">
        <img src="https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_960_720.png" class="avatar">
        <h1 class="log">Login</h1>
        <form method="POST" action="process_login.php">
            <p>Email Address</p>
            <input type="text" name="user_email" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="pass" placeholder="Enter Password">
            <input type="submit" name="login" value="Login">
            <a href="registration.php">Sign up</a><br>
            <a href="index.php">Homepage</a>
        </form>
    </div>

</body>

</html>