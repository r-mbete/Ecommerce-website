<?php
require("connection.php");

$sql="SELECT  user_id, first_name, last_name, email, tel_number, gender, role FROM tbl_users";
$result = mysqli_query($conn , $sql);

//if (isset($_GET["edit"])){
   // $id=$_GET["edit"];
   // $sql="SELECT * FROM tbl_users WHERE user_id=$id";
    
    
//}

//$records= 
//$data=array();
//while ($data =mysql_fetch_assoc($records))
//{
   //$projects[] = $project;
//}
//$result = mysqli_query($conn, $sql);
//for($i = 0; $data[$i] = mysqli_fetch_assoc($result); $i++) ;
//array_pop($data);
//while($data[]=mysqli_fetch_array($sql, MYSQL_ASSOC));
//$data = mysqli_fetch_array($sql);
//$num = mysqli_numrows($sql);
//if ($result = mysqli_query($conn,$sql)){

//while ($data = mysqli_fetch_row($result)) {
    //printf ("%s (%s)\n", $data[0], $data[1],$data[2],$data[3],$data[4],$data[5],$data[6]);
  //}
  //mysqli_free_result($result);
//}



?>