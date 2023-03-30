<?php

require('connection.php');
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql = "SELECT * FROM tbl_product WHERE product_id=$id";

  }

if(isset($_POST['update_product'])){

    $itemname=$_POST["itemname"];
    $description=$_POST["description"];
    $image=$_POST["image"];
    $unitprice=$_POST["unitprice"];
    $quantity=$_POST["quantity"];


    $product_image_tmp_name = $_FILES['image']['tmp_name'];
    $product_image_folder = 'upload/'. $image;
    move_uploaded_file($image_tmp_name, $image_folder);

    $update_data = "UPDATE tbl_product SET product_name='$itemname',product_description='$description',product_image='$image',unit_price='$unitprice', available_quantity='$quantity', subcategory_id='$subcategory_id', created_at='$created_at',updated_at='$updated_at',added_by='$added_by',is_deleted='$is_deleted' WHERE product_id = '$id'";
    $upload = mysqli_query($conn, $update_data);

   }

?>



<html>

<head>
    <title>Update Product</title>
    <style>
    body {
        background-color: white;
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


    <h2 class="log">Edit Items</h2>

    <div class="reg-form">
        <?php

        $query = "SELECT * FROM tbl_product";
        $select = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($select)){

        ?>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <p>Item Name</p>
            <input type="text" name="itemname" id="item" value="<?php $row['product_name']; ?>" placeholder="Item Name">
            <p>Item Description</p>
            <input type="text" name="description" id="desc" value="<?php $row['product_description']; ?>"
                placeholder="Description">
            <p>Product Image</p>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" id="image"
                placeholder="Load Image Here">
            <p>Unit Price</p>
            <input type="text" name="unitprice" id="price" value="<?php $row['unit_price']; ?>"
                placeholder="Unit Price">
            <p>Available Quantity</p>
            <input type="text" name="quantity" id="qnty" value="<?php $row['available_quantity']; ?>"
                placeholder="Quantity">
            <input type="submit" name="update_product" value="Update product">
            <a href="display_product.php" class="btn">Back to Products</a>
        </form>
        <?php 
        
        };
        
        ?>
    </div>



</body>

</html>