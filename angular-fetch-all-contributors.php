<?php

include_once("connect-to-db.php");


$query="select * from  contributorProfile ";

$table=mysqli_query($dbref,$query);
$count=mysqli_num_rows($table);

/*if($count==0)//to check whether fine query or not
    echo "Invalid  Details";
else
    echo"Welcome";*/

$ary=array();

while($row=mysqli_fetch_array($table))//be careful with the statement
{
    $ary[]=$row;
}
echo json_encode($ary);


/* before going to frontend- check backend, by previewing and in url fivivg passed details or details being  fetched using post*/
?>