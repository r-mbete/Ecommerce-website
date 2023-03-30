<html>

<head>
    <title>User Display</title>

</head>


<link rel="stylesheet" type="text/css" href="styl.css" />


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
                    <td><a href=user_edit_process.php?edit="<?php echo $data["user_id"] ?>">View</a></td>
                </tr>
                <?php
                
                        }
                ?>


            </tbody>
        </table>

    </div>


</body>

</html>