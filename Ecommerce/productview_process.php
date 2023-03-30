<?php
include_once 'connection.php';
if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE tbl_product set product_id='" . $_POST['product_id'] . "', product_name='" . $_POST['product_name'] . "', unit_price='" . $_POST['unit_price'] . "', available_quantity='" . $_POST['available_quantity'] . "' ,product_image='" . $_POST['product_image'] . "' WHERE product_id='" . $_POST['product_id'] . "'");
    $message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM tbl_product WHERE product_id='" . $_GET['prodcut_id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>

<head>
    <title>Update Products Data</title>
</head>

<body>
    <form name="frmUser" method="post" action="">
        <div><?php if(isset($message)) { echo $message; } ?>
        </div>
        <div style="padding-bottom:5px;">
            <a href="admin.php">Product Data</a>
        </div>
        Username: <br>
        <input type="hidden" name="id" class="txtField" value="<?php echo $row['product_id']; ?>">
        <input type="text" name="id" value="<?php echo $row['product_id']; ?>">
        <br>
        First Name: <br>
        <input type="text" name="name" class="txtField" value="<?php echo $row['product_name']; ?>">
        <br>
        Last Name :<br>
        <input type="text" name="price" class="txtField" value="<?php echo $row['unit_price']; ?>">
        <br>
        City:<br>
        <input type="text" name="quantity" class="txtField" value="<?php echo $row['available_quantity']; ?>">
        <br>
        Email:<br>
        <input type="text" name="img" class="txtField" value="<?php echo $row['product_image']; ?>">
        <br>
        <input type="submit" name="submit" value="submit" class="buttom">

    </form>
</body>

</html>