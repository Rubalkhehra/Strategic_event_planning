<?php
include_once("SMS_OK_sms.php");
//in place of process file,get inout through ajax to get input
include_once("connect-to-db.php");

//since using ajax to take input therefore use egt function
$uid=$_GET["uid"];//earlier in " " was name, but now use key from ajax function
$pwd=$_GET["pwd"];
$mob=$_GET["mob"];
$cat=$_GET["cat"];
$pwdd=$pwd;
$pwd=md5($pwd);//????????????????????needed else pwd not encrypted


$query="insert into users values('$uid','$pwd','$mob','$cat')";

mysqli_query($dbref,$query);

$msg=mysqli_error($dbref);

if($msg=="")
{
       if($cat=="contributor")
       {
           $resp=SendSMS($mob,"Thank you dear ".$uid." for joining with us.Your password is ".$pwdd." We wish many clients avail your services! ");
       }
    
    else if($cat=="client")
    {
        $resp=SendSMS($mob,"Thank you dear ".$uid." for joining with us.Your password is ".$pwdd." We wish a successfull event planning! ");
    }
    
    echo "Successfully signed in\n".$resp;

}

else  
echo $msg;


?>
