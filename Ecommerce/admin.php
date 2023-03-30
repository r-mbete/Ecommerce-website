<html>

<head>
    <title>Categories Management</title>
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

        <ul class="menu">
            <li><a href="admin.php" class="active">Edit Categories</a></li>
            <li><a href="sub-cat.php">Edit Sub-Categories</a></li>
            <li><a href="item.php">Add Items</a></li>
            <li><a href="user.php">Add Users</a></li>
            <li><a href="user_edit.php">View All Users</a></li>
            <li><a href="item_edit.php">View All Items</a></li>


        </ul>
    </nav>



    <h2 class="log">Edit categories</h2>
    <div class="reg-form">
        <form action="cat.php" method="post">
            <p>Category Name</p>
            <input type="text" name="category" id="cat" placeholder="Category">
            <input type="submit" name="" value="Submit">
        </form>
    </div>


</body>

</html>