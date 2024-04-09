<?php
include_once("connect-to-db.php");
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];

$query="select * from admin where uid='$uid' and pwd='$pwd'";

$table=mysqli_query($dbref,$query);
$count=mysqli_num_rows($table);
if($count==0)
    echo "Invalid Admin Details";
else
    echo"Welcome Admin!";
/* before going to frontend- check backend, by previewing and in url fivivg passed details or details being  fetched using post*/
?>