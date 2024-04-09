<?php
include_once("connect-to-db.php");

$uidd=$_GET["uid"];

$query="select *from users where uid='$uidd'";
$table=mysqli_query($dbref,$query);
$count=mysqli_num_rows($table);

if($count==1)
    echo"<span style='color:red;font-size:16px'>Username already exists</span>";
else
    echo"<span style='color:green;font-size:16px'>Valid username</span>";


?>