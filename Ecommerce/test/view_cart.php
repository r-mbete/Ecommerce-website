<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Simple Shopping Cart using Session in PHP</title>
    

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
            <div class="container-fluid">
                <div class="navbar-header">

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <!-- left nav here -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="view_cart.php"><span
                                    class="badge"><?php echo count($_SESSION['cart']); ?></span>
                                <i class="fas fa-shopping-bag"></i></a></li>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="index.php">Products</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 class="page-header text-center">Cart Details</h1>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?php 
			if(isset($_SESSION['message'])){
				?>
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php
				unset($_SESSION['message']);
			}

			?>
                <form method="POST" action="save_cart.php">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <?php
						//initialize total
						$total = 0;
						if(!empty($_SESSION['cart'])){
						//connection
						require('connection.php');
						//create array of initail qty which is 1
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
 						}
						$sql = "SELECT * FROM tbl_product WHERE product_id IN (".implode(',',$_SESSION['cart']).")";
						$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
								?>
                            <tr>
                                <td>
                                    <a href="delete_item.php?id=<?php echo $row['product_id']; ?>&index=<?php echo $index; ?>"
                                        class="btn btn-danger btn-sm"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                                </td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo number_format($row['unit_price'], 2); ?></td>
                                <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                <td><input type="text" class="form-control"
                                        value="<?php echo $_SESSION['qty_array'][$index]; ?>"
                                        name="qty_<?php echo $index; ?>"></td>
                                <td><?php echo number_format($_SESSION['qty_array'][$index]*$row['unit_price'], 2); ?>
                                </td>
                                <?php $total += $_SESSION['qty_array'][$index]*$row['unit_price']; ?>
                            </tr>
                            <?php
								$index ++;
							}
						}
						else{
							?>
                            <tr>
                                <td colspan="4" class="text-center">No Item in Cart</td>
                            </tr>
                            <?php
						}

					?>
                            <tr>
                                <td colspan="4" align="right"><b>Total</b></td>
                                <td><b><?php echo number_format($total, 2); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>
                        Back</a>
                    <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                    <a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                        Clear Cart</a>
                    <a href="checkout.php" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>
                        Checkout</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>