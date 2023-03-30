<html>

<head>
    <title>Item Edit</title>
    <style>
    body {
        background-color: #dbcaca;
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
    <h2 class="title">Display Item</h2>
    <div class="table">
        <table>
            <thead>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Unit Price</th>
                <th>Category Name</th>
                
            </thead>

            <tbody>
                <?php
                        require("item_edit_process.php");
                        
                        while ($data = mysqli_fetch_assoc($result)){
                        ?>
                <tr>
                    <td><?php echo $data["product_name"] ?></td>
                    <td><?php echo $data["product_description"] ?></td>
                    <td><?php echo $data["product_image"] ?></td>
                    <td><?php echo $data["unit_price"] ?></td>
                    <td><?php echo $data["category_name"] ?></td>
                    <td><a href=user_edit_process.php?edit="<?php echo $data["product_id"] ?>">Edit</a></td>
                </tr>
                <?php
                
                        }
                ?>


            </tbody>
        </table>
        <a href="admin.php">Back to Admin Module</a>

    </div>


</body>

</html>