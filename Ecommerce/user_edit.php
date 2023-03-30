<html>

<head>
    <title>User Edit</title>
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
    <h2 class="title">Display User</h2>
    <div class="table">
        <table>
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Telephone Number</th>
                <th>Gender</th>
                <th>Role</th>
            </thead>

            <tbody>
                <?php
                        require("user_edit_process.php");
                        
                        while ($data = mysqli_fetch_assoc($result)){
                        ?>
                <tr>
                    <td><?php echo $data["first_name"] ?></td>
                    <td><?php echo $data["last_name"] ?></td>
                    <td><?php echo $data["email"] ?></td>
                    <td><?php echo $data["tel_number"] ?></td>
                    <td><?php echo $data["gender"] ?></td>
                    <td><?php echo $data["role"] ?></td>
                    <td><a href=user_edit_process.php?edit="<?php echo $data["user_id"] ?>">Edit</a></td>
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