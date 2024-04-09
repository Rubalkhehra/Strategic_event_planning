<?php

include_once("connect-to-db.php");
$function=$_GET["function"];
$query="select services from planner where function='$function'";
$table=mysqli_query($dbref,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);
?>