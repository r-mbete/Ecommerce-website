<html>

<head>
    <title>Unisex</title>
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
    <section class="products 1">
        <?php
        require("connection.php")
        
        $sql="SELECT * FROM tbl_product WHERE category_id="04" ";
        $results = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            echo "<table>";
                echo "<tr>";
                    echo "<th>Product Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Price</th>";
                    echo "<th>Add to cart</th>";
                echo "</tr>";
        }
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['product_description'] . "</td>";
            echo "<td>" . $row['unit_price'] . "</td>";
            echo "<td> <a href=productcatview.php?id=" .$row["product_id"]. ">Add to Cart</a> </td>";
            echo "</tr>";
        }
        ?>

    </section>
</body>

</html>