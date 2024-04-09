<?php
session_start();//to use global session array, avail i t

include_once("connect-to-db.php");

$uidd=$_GET["uid"];
$pwdd=$_GET["pwd"];
$pwdd=md5($pwdd);//IN TABLE pwd stored in encrypted form

//?????/get category--not good way
$query="select * from users where uid='$uidd'and pwd='$pwdd'";
$table=mysqli_query($dbref,$query);
$count=mysqli_num_rows($table);


if($count==1)
{    
//$ary=array();--no need ,need array in json
while($row=mysqli_fetch_array($table))
{
    $_SESSION["uid"]=$uidd;
    echo $row["category"];
    
}
    
}
else
    echo"Sorry! We couldn't identify you";

?>
