<?php
include_once("connect-to-db.php");

/*
this way work when its process files and use submit button and names in []

$uid=$_GET["txtUid"]; 
$fun=$_GET["functions"];
$selServ=$_GET["selservice"];*/


//condition that no null value received, can put here???-better make field required in frontend(but how make select/combo required)????????????????pass values as in signin????

$uid=$_GET["uid"]; //no gap between $ and uid  
$fun=$_GET["functions"];
$selServ=$_GET["selServices"];

$queryPrior="select *from contributorServices where uid='$uid' and function='$fun'";

$table=mysqli_query($dbref,$queryPrior);
$count=mysqli_num_rows($table);
if($count==1)
    echo "You have already contributed in this function!For any changes do UPDATE";
else
{
    
    $query="insert into contributorServices values('$uid','$fun','$selServ')";

    mysqli_query($dbref,$query);
    $msg=mysqli_error($dbref);
    if($msg=="")
        echo "Successfully saved";
    else
        echo"Sorry,couldn't save";
}
/*"<span style='color:red;font-size:20px'>You have already contributed in this function!<br></span>For any changes do UPDATE"*/
?>
