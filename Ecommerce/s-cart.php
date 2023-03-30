<?php
require('connection.php');

 
 if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `tbl_cart` SET quantity = '$update_quantity' WHERE cart_id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
 }
 
 if(isset($_GET['remove'])){
 //   $remove_id = $_GET['remove'];
 //   mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE cart_id = '$remove_id'") or die('query failed');
 //   header('location:a-cart.php');
 //}
   
 //if(isset($_GET['delete_all'])){
 //   mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
 //   header('location:s-cart.php');
 //}

//..........
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
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
if (isset($_POST['update_cart']) && isset($_SESSION['cart'])) {
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
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
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
        background-color: purple;
    }

    .btn {
        background-color: purple;
        margin-top: 10px;
    }

    .delete-btn {
        background-color: var(--purple);
    }

    .option-btn {
        background-color: purple;
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
        background-color: gray;
    }

    .container .shopping-cart table thead {
        background-color: gray;
    }

    .container .shopping-cart table thead th {
        padding: 10px;
        color: white;
        text-transform: capitalize;
        font-size: 20px;
    }

    .container .shopping-cart table .table-bottom {
        background-color: white;
    }

    .container .shopping-cart table tr td {
        padding: 10px;
        font-size: 20px;
        color: gray;
    }

    .container .shopping-cart table tr td:nth-child(1) {
        padding: 0;
    }

    .container .shopping-cart table tr td input[type="number"] {
        width: 80px;
        border: var(--border);
        padding: 12px 14px;
        font-size: 20px;
        color: gray;
    }

    .container .shopping-cart .cart-btn {
        margin-top: 10px;
        text-align: center;
    }

    .container .shopping-cart .disabled {
        pointer-events: none;
        background-color: var(--purple);
        opacity: .5;
        user-select: none;
    }
    </style>
</head>

<link rel="stylesheet" type="text/css" href="styl.css" />



<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

<body class=body>
    <div class="container">
        <div class="shopping-cart">
            <h2 id="cate">Shopping Cart</h2>
            <table>
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php
        $cart = mysqli_query($conn, "SELECT * FROM tbl_cart");
        if(mysqli_num_rows($cart) >= 0){
        while($fetch_cart = mysqli_fetch_assoc($cart)){
        ?>
                    <tr>
                        <td><img src="upload/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['product_name']; ?></td>
                        <td>$<?php echo $fetch_cart['unit_price']; ?>/-</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
                                <input type="number" min="1" name="cart_quantity"
                                    value="<?php echo $fetch_cart['quantity']; ?>">
                                <input type="submit" name="update_cart" value="update" class="option-btn">
                            </form>
                        </td>
                        <td>$<?php echo $sub_total = ($fetch_cart['unit_price'] * $fetch_cart['quantity']); ?>/-</td>
                        <td><a href="index.php?remove=<?php echo $fetch_cart['cart_id']; ?>" class="delete-btn"
                                onclick="return confirm('remove item from cart?');">Remove</a></td>
                    </tr>
                    <?php
         //$grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
                    <tr class="table-bottom">
                        <td colspan="4">Grand total :</td>
                        <td>KES.<?php //echo $grand_total; ?>/-</td>
                        <td><a href="index.php?delete_all" onclick="return confirm('Delete all from cart?');"
                                class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Delete All</a></td>
                    </tr>
                </tbody>
            </table>

            <div class="cart-btn">
                <a href="#" class="btn 
                <?php 
                //echo ($grand_total > 1)?'':'disabled'; 
                ?> ">Proceed to Checkout</a>
            </div>
            <div class="cart-btn">
                <a href="index.php" class="btn">Back to Home Page</a>
            </div>
        </div>
    </div>
</body>

</html>