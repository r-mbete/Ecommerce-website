<?php
require("connection.php");

if (isset($_GET["edit"])){
    $id=$_GET["edit"];
    $sql="SELECT * FROM tbl_product WHERE product_id=$id";
    
    
}


?>