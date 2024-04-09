<?php

include_once("connect-to-db.php");
$query="select distinct state from contributorProfile";
$table=mysqli_query($dbref,$query);;
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);
?>