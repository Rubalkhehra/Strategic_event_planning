<?php

include_once("connect-to-db.php");
$uid=$_POST["txtUid"];  
$name=$_POST["txtName"]; 
$name=ucwords($name);//converts all words in   name  to uppercase
$city=$_POST["txtCity"];  
$city=ucwords($city);//converts all words in  city name  to uppercase
$dob=$_POST["txtDob"];  
$address=$_POST["txtAddress"];  
$occ=$_POST["txtOcc"];
$mobile=$_POST["txtMob"];
$email=$_POST["txtEmail"];
$btn=$_POST["btn"];

if($btn=="Save")
{
   $picname=$_FILES["ppic"]["name"]; 
   $temp_name=$_FILES["ppic"]["tmp_name"];
   move_uploaded_file($temp_name,"uploads_client/".$picname);
   
if($picname=="")
{
  $picname="noImageAvail.jpg";//save it pehle se in uploads  
}
    
    /* upload-client-------wrong folder name*/
    
    $query= "insert into clientProfile values('$uid','$name','$mobile','$dob','$address','$city','$email','$occ','$picname')";
    mysqli_query($dbref,$query);
    $msg=mysqli_error($dbref);
    if($msg=="")
        header("location:result.php?msg=Your data has been SAVED successfully!");
     //   echo"Successfully recorded";
    //   else//no need as abhi no chakkar of uid, duplicate key as we fill it ourselves and have ut validations
   //     echo $msg;
    
}
else/* update occur only afetr fetching current dtat, so update with json*/
{    
   $picname=$_FILES["ppic"]["name"]; 
    $hdn=$_POST["hdn"];
   $temp_name=$_FILES["ppic"]["tmp_name"];
    if($picname=="")
        $picname=$hdn;
    else
    move_uploaded_file($temp_name,"uploads_client/".$picname);
    //column names kept same as variable names in which store value from names/textbox
     $query= "update clientProfile  set name='$name',mobile='$mobile',dob='$dob',address='$address',city='$city',email='$email',occupation='$occ',pic='$picname' where uid='$uid'";
    /* where must  in the update query*/
    mysqli_query($dbref,$query);
    $msg=mysqli_error($dbref);
    if($msg=="")
        header("location:result.php?msg=Your data has been UPDATED successfully!");
     //   echo"Successfully recorded";
    //   else//no need as abhi no chakkar of uid, duplicate key as we fill it ourselves and have ut validations
   //     echo $msg;
       
}
?>
