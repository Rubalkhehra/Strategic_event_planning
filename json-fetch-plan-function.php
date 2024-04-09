<?php
include_once("connect-to-db.php");
$query="select distinct function from contributorServices";

$table=mysqli_query($dbref,$query);
$ary=array();//multiple data send through json array
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;    
}
echo json_encode($ary);

?>