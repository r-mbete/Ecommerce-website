<html>

<head>
    <title>User Management</title>
    <style>
    body {
        background-color: #dbcaca;
        font-family: poppins;
    }
    </style>
</head>

<link rel="stylesheet" type="text/css" href="styl.css" />



<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

<body>
    <nav class="nav">
        <a class="logo">Just Be You</a>
        <p>Admin</p>

        <ul class="menu">
            <li><a href="admin.php">Edit Categories</a></li>
            <li><a href="sub-cat.php">Edit Sub-Categories</a></li>
            <li><a href="item.php">Add/Edit Items</a></li>
            <li><a href="user.php" class="active">Add/Edit Users</a></li>
            <li><a href="user_edit.php">View All Users</a></li>
            <li><a href="item_edit.php">View All Items</a></li>,
        </ul>
    </nav>

    <h2 class="log">Add/Edit Users</h2>
    <div class="reg-form">
        <form action="user_process.php" method="post">
            <p>First Name:</p>
            <input type="text" name="firstname" id="fname" placeholder="First Name">
            <p>Last Name:</p>
            <input type="text" name="lastname" id="lname" placeholder="Last Name">
            <p>Gender:</p>
            <input type="text" name="gender" id="gender" placeholder="Gender">
            <p>Phone Number:</p>
            <input type="tel" name="phone number" id="tel" placeholder="Phone Number">
            <p>Email Address:</p>
            <input type="email" name="email" id="email" placeholder="Email">
            <p>Password:</p>
            <input type="password" name="password" id="pass" placeholder="Password">
            <input type="submit" name="" value="Submit">
        </form>
    </div>


</body>

</html>