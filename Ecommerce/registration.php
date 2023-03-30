<html>

<head>
    <title>Register</title>
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
    <div class="reg-form">
        <img src="test/upload/avatar.png"
            class="reg-av">
        <h1 class="log">Register Your Details!!</h1>
        <form action="process_reg.php" method="post">
            <p>First Name:</p>
            <input type="text" name="firstname" id="fname" placeholder="First Name">
            <p>Last Name:</p>
            <input type="text" name="lastname" id="lname" placeholder="Last Name">
            <p>Gender:</p>
            <input type="text" name="gender" id="gender" placeholder="Gender">
            <p>Phone Number:</p>
            <input type="tel" name="number" id="tel" placeholder="Phone Number">
            <p>Email Address:</p>
            <input type="email" name="email" id="email" placeholder="Email">
            <p>Password:</p>
            <input type="password" name="password" id="pass" placeholder="Password">
            <input type="submit" name="" value="Register">


        </form>
    </div>
</body>

</html>