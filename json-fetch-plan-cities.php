<?php

include_once("connect-to-db.php");
$state=$_GET["state"];
$query="select distinct city from contributorProfile where state='$state'";
$table=mysqli_query($dbref,$query);;
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);
?>