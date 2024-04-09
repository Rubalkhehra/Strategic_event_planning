<?php
include_once("connect-to-db.php");
$query="select distinct function from planner";
$table=mysqli_query($dbref,$query);
$ary=array();//multiple data send through json array
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;    
}
echo json_encode($ary);//return array of objects --boz many rows ,also can verify from many {}


?>


