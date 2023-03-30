<?php
	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	//unset qunatity
	unset($_SESSION['qty_array']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopping Cart </title>
    

    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <style>
    body {
        background-color: white;
        font-family: poppins;
    }

   

    .product_image {
        height: 200px;
    }

    .product_name {
        height: 80px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .product_footer {
        padding-left: 20px;
        padding-right: 20px;
    }

    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 10%;
        margin: auto;
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        z-index: 100;
        background-color: black;
        border: 1px solid black;
    }

    .right-elements {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-elements a {
        margin: 0px 10px;
    }

    .right-elements a i {
        color: #4f4747;
    }

    .right-elements a:hover i {
        color: antiquewhite;
        transition: all ease 0.2s;
    }

    .panel-body {
        margin-top: 100px;
    }

    .logo {
        font-size: 2.1rem;
        color: #342c2c;
        text-transform: uppercase;
    }

    .menu {
        display: flex;
    }

    .menu li a {
        margin: 5px;
        padding: 5px 20px;
        color: antiquewhite;
        font-weight: 500;
        opacity: 0.4;

    }

    .menu .active {
        opacity: 1;
    }

    .menu li a:hover {
        opacity: 1;
        transition: all ease 0.3s;
    }
    </style>
</head>

<body>
    <div class="container">
        <nav class="nav">
            <a class="logo">Just Be You</a>
            <div class="container-fluid">
                <div class="navbar-header">

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="view_cart.php"><span class="badge"><?php echo count($_SESSION['cart']); ?></span>
                                <i class="fas fa-shopping-bag"></i></a></li>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="index.php">Products</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
		//info message
		if(isset($_SESSION['message'])){
			?>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
            </div>
        </div>
        <?php
			unset($_SESSION['message']);
		}
		//end info message
		//fetch our products	
		//connection
		require('connection.php');

		$sql = "SELECT * FROM tbl_product";
		$query = $conn->query($sql);
		$inc = 4;
		while($row = $query->fetch_assoc()){
			$inc = ($inc == 4) ? 1 : $inc + 1; 
			if($inc == 1) echo "<div class='row text-center'>";  
			?>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row product_image">
                        <img src="upload/<?php echo $row['product_image'] ?>" width="80%" height="auto">
                    </div>
                    <div class="row product_name">
                        <h4><?php echo $row['product_name']; ?></h4>
                    </div>
                    <div class="row product_footer">
                        <p class="pull-left"><b><?php echo $row['unit_price']; ?></b></p>
                        <span class="pull-right"><a href="add_cart.php?id=<?php echo $row['product_id']; ?>"
                                class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>
                                Cart</a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
		}
		if($inc == 1) echo "<div></div><div></div><div></div></div>"; 
		if($inc == 2) echo "<div></div><div></div></div>"; 
		if($inc == 3) echo "<div></div></div>";
		
		//end product row 
	?>
    </div>
</body>

</html>