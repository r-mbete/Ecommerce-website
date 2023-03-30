<?php
require('connection.php');
session_start();
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['available_quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['available_quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM tbl_products WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM tbl_products WHERE product_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['unit_price'] * (int)$products_in_cart[$product['product_id']];
    }
}
?>
<html>

<head>
    <title>Shopping Cart</title>
    <style>
    body {
        background-color: #dbcaca;
        font-family: poppins;
    }

    .btn,
    .delete-btn,
    .option-btn {
        display: inline-block;
        padding: 10px 30px;
        cursor: pointer;
        font-size: 18px;
        color: #9f8888;
        border-radius: 5px;
        text-transform: capitalize;
    }

    .btn:hover,
    .delete-btn:hover,
    .option-btn:hover {
        background-color: #4f4747;
    }

    .btn {
        background-color: #5d5252;
        margin-top: 10px;
    }

    .delete-btn {
        background-color: var(--red);
    }

    .option-btn {
        background-color: #7d6a6a;
    }

    .container .shopping-cart {
        padding: 20px 0;
    }

    .container .shopping-cart table {
        width: 100%;
        text-align: center;
        border: var(--border);
        border-radius: 5px;
        box-shadow: var(--box-shadow);
        background-color: #9f8888;
    }

    .container .shopping-cart table thead {
        background-color: #5d5252;
    }

    .container .shopping-cart table thead th {
        padding: 10px;
        color: antiquewhite;
        text-transform: capitalize;
        font-size: 20px;
    }

    .container .shopping-cart table .table-bottom {
        background-color: #dbcaca;
    }

    .container .shopping-cart table tr td {
        padding: 10px;
        font-size: 20px;
        color: #342c2c;
    }

    .container .shopping-cart table tr td:nth-child(1) {
        padding: 0;
    }

    .container .shopping-cart table tr td input[type="number"] {
        width: 80px;
        border: var(--border);
        padding: 12px 14px;
        font-size: 20px;
        color: #342c2c;
    }

    .container .shopping-cart .cart-btn {
        margin-top: 10px;
        text-align: center;
    }

    .container .shopping-cart .disabled {
        pointer-events: none;
        background-color: var(--red);
        opacity: .5;
        user-select: none;
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
        <div class="shopping-cart">
            <h2 id="cate">Shopping Cart</h1>
                <form method="post">
                    <table>
                        <thead>
                            <tr>
                                <td colspan="2">Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">You have no products added in your Shopping
                                    Cart</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="img">
                                    <a href="index.php?page=product&id=<?=$product['id']?>">
                                        <img src="imgs/<?=$product['img']?>" width="50" height="50"
                                            alt="<?=$product['name']?>">
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                                    <br>
                                    <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                                </td>
                                <td class="price">&dollar;<?=$product['price']?></td>
                                <td class="quantity">
                                    <input type="number" name="quantity-<?=$product['id']?>"
                                        value="<?=$products_in_cart[$product['id']]?>" min="1"
                                        max="<?=$product['quantity']?>" placeholder="Quantity" required>
                                </td>
                                <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="cart-btn">
                        <span class="text">Subtotal</span>
                        <span class="price">&dollar;<?=$subtotal?></span>
                    </div>
                    <div class="cart-btn">
                        <input type="submit" value="Update" name="update" class="btn">
                        <input type="submit" value="Place Order" name="placeorder" class="btn">
                    </div>
                    <div class="cart-btn">
                        <a href="index.php" value="Back to Home Page" name="Back to Home Page" class="btn">Back to Home
                            Page</a>
                    </div>
                </form>
        </div>
    </div>
</body>

</html>