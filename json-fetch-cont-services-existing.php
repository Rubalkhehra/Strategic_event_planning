<?php
include_once("connect-to-db.php");

$function= $_GET["function"];
$uid= $_GET["uid"];


//take loca vars and col names same, so that no confusion where to take what
$query="select services from contributorservices where function='$function' and uid='$uid'";

$table=mysqli_query($dbref,$query);
$ary=array();//multiple data send through json array
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
    
}
echo json_encode($ary);//return 1object ---verify only 1{ }


?>


