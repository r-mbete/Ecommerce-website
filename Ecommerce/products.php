<?php
        require("connection.php");

        if(isset($_POST['add_to_cart'])){

            $product_name = $_POST['product_name'];
            $product_price = $_POST['unit_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['quantity'];
         
            $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE product_name = '$product_name'") or die('query failed');
         
            if(mysqli_num_rows($select_cart) > 0){
               $message[] = 'product already added to cart!';
            }else{
               mysqli_query($conn, "INSERT INTO `tbl_product`( product_name, unit_price, product_image, quantity) VALUES( '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
               $message[] = 'product added to cart!';
            }
         
         };

?>


<html>

<head>
    <title>Women</title>
    <style>
    body {
        background-color: white;
        font-family: poppins;
    }

    .container {
        margin-top: 90px;
    }

    .container .products .box-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .container .products .box-container .box {
        text-align: center;
        border-radius: 5px;
        box-shadow: var(--box-shadow);
        border: var(--border);
        position: relative;
        padding: 20px;
        background-color: var(--white);
        width: 350px;
    }

    .container .products .box-container .box img {
        height: 250px;
    }

    .container .products .box-container .box .name {
        font-size: 20px;
        color: var(--black);
        padding: 5px 0;
    }

    .container .products .box-container .box .price {
        position: absolute;
        bottom: 150px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: var(--orange);
        color: var(--white);
        font-size: 25px;
    }

    .container .products .box-container .box input[type="number"] {
        margin: 10px 0;
        width: 100%;
        border: var(--border);
        border-radius: 5px;
        font-size: 20px;
        color: var(--black);
        padding: 12px 14px
    }
    </style>
</head>

<link rel="stylesheet" type="text/css" href="styl.css" />

<link rel="website icon"
    href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSfl0noNtOx_iSpSPsAELHYG8M1jMH9p-_Tg&usqp=CAU"
    class="log">

<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

<body class>
    <nav class="nav">
        <a class="logo">Just Be You</a>

        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="products.pho" class="active">Products</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>

        <div class="right-elements">
            <a href="#" class="search">
                <i class="fas fa-search"></i>
            </a>

            <a href="cart.php" class="cart">
                <i class="fas fa-shopping-bag"></i>

            </a>

            <a href="login.php" class="user">
                <i class="fas fa-user"></i>

            </a>

        </div>

    </nav>
    <div class="container">
        <section class="products">
            <div class="box-container">
                <?php

        $sql="SELECT * FROM tbl_product ";
        $results = mysqli_query($conn,$sql);
       
         if(mysqli_num_rows($results) > 0){
         while($fetch_product = mysqli_fetch_assoc($results)){
   ?>
                <form method="post" class="box" action="cart.php?page=cart">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?>">
                    <img src="upload/<?php echo $fetch_product['product_image']; ?>" alt="">
                    <div class="name"><?php echo $fetch_product['product_name']; ?></div>
                    <div class="price">$<?php echo $fetch_product['unit_price']; ?>/-</div>
                    <input type="number" min="1" name="available_quantity" value="1">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
                    <input type="hidden" name="unit_price" value="<?php echo $fetch_product['unit_price']; ?>">
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </form>
                <?php
      };
   };
   ?>
            </div>
        </section>
    </div>
</body>

</html>