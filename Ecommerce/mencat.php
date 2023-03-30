<?php
require('connection.php');
// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM tbl_product');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM tbl_product')->rowCount();
?>

<html>

<head>
    <title>Men</title>
    <style>
    body {
        background-color: #dbcaca;
        font-family: poppins;
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

<body>
    <div class="container">
        <h2 class="log">Products</h2>
        <p><?=$total_products?> Products</p>
        <div class="box-container">
            <?php foreach ($products as $product): ?>
            <a href="index.php?page=product&id=<?=$product['product_id']?>" class="product">
                <img src="imgs/<?=$product['product_image']?>" width="200" height="200"
                    alt="<?=$product['product_name']?>">
                <span class="name"><?=$product['product_name']?></span>
                <span class="price">
                    &dollar;<?=$product['unit_price']?>
                    <?php if ($product['rrp'] > 0): ?>
                    <span class="rrp">&dollar;<?=$product['rrp']?></span>
                    <?php endif; ?>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="btn">
            <?php if ($current_page > 1): ?>
            <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
            <?php endif; ?>
            <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
            <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>