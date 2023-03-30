<?php
require('connection.php');

$itemname=$_POST["itemname"];
$description=$_POST["description"];
$image=$_POST['image'];
$unitprice=$_POST["unitprice"];
$quantity=$_POST["quantity"];

//$product_image_tmp_name = $_FILES['image']['tmp_name'];
$product_image_folder = 'upload/'. $image;

$sql = "INSERT INTO tbl_product(product_name,product_description,product_image,unit_price,available_quantity)
VALUES('$itemname','$description','$image','$unitprice','$quantity')";
  $upload = mysqli_query($conn, $sql);
  move_uploaded_file($product_image_tmp_name, $product_image_folder);


  header('location:admin.php');


$conn->close();
?>