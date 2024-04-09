<?php

include_once("connect-to-db.php");
$uidd=$_GET["uid"];
$query="select * from clientProfile where uid='$uidd'";

$table=mysqli_query($dbref,$query);//fired query
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);


?>