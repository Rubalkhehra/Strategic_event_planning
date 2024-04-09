<?php

include_once("connect-to-db.php");
$functions=$_GET["function"];
$service=$_GET["service"];
$state=$_GET["state"];
$city=$_GET["city"];


$query="select * from contributorProfile where state='$state' and city='$city' and uid in
(select uid as 'uid' from contributorServices where function='$functions' and services like '%$service%')";

//and uid in 
//(select uid as 'uid' from contributorProfile where state='$state' and city='$city'))";

$table=mysqli_query($dbref,$query);
$count=mysqli_num_rows($table);


/*    
    $count=mysqli_num_rows($table);
    echo "count= ".$count;
    can echo 1+ thing but do problemin angular................ andalso after end of file kuch mat likho, else again get-----
    as get 2 echos--ng-repaet dupes error
    */

$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);
?>

