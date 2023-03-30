<html>

<head>
    <title>Display Product</title>
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
    <div class="table">
        <table>
            <thead>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Sub-Category</th>
                <th>Edit</th>
            </thead>

            <tbody>
                <?php
                        require("connection.php");
                        $sql= "SELECT * FROM tbl_product";
                        $result = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_assoc($result)){
                        ?>
                <tr>
                    <td><?php  $data["product_name"] ?></td>
                    <td><?php  $data["product_description"] ?></td>
                    <td><img src="upload/" <?php  echo $data["product_image"] ?> height="100" alt=""></td>
                    <td><?php  $data["unit_price"] ?></td>
                    <td><?php  $data["available_quantity"] ?></td>
                    <td><?php  $data["subcategory_id"] ?></td>
                    <td><a href=productview_process.php?id="<?php  echo $data["product_id"]; ?>"> <i
                                class="fas fa-edit">Edit</i></a></td>
                </tr>
                <?php
                }
                        
                ?>


            </tbody>
        </table>

    </div>

</body>

</html>