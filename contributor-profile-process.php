<?php

include_once("connect-to-db.php");
$uid=$_POST["txtUid"];  
$name=$_POST["txtName"];  
$name=ucwords($name);//converts all words in   name  to uppercase
$city=$_POST["txtCity"];  
$city=ucwords($city);//converts all words in  city name  to uppercase
$state=$_POST["txtState"];   
$off_address=$_POST["txtOffAddress"];  
$mobile=$_POST["txtMob"];
$off_mobile=$_POST["txtOffMob"];
$bus_name=$_POST["txtBus"];
$estd=$_POST["txtEstd"];

$btn=$_POST["btn"];

$picname1=$_FILES["ppic1"]["name"]; 
   $temp_name1=$_FILES["ppic1"]["tmp_name"];
    
$picname2=$_FILES["ppic2"]["name"]; 
   $temp_name2=$_FILES["ppic2"]["tmp_name"];
    
$picname3=$_FILES["ppic3"]["name"]; 
   $temp_name3=$_FILES["ppic3"]["tmp_name"];

if($btn=="Save")
{
     /* upload-client-------wrong name*/
 if($picname1=="")
  $picname1="noImageAvail.jpg";//save it pehle se in uploads  
else    move_uploaded_file($temp_name1,"uploads_contributor/".$picname1);
  
if($picname2=="")
  $picname2="noImageAvail.jpg";
else 
move_uploaded_file($temp_name2,"uploads_contributor/".$picname2);
    
if($picname3=="")
  $picname3="noImageAvail.jpg";//save it pehle se in uploads  
else 
    move_uploaded_file($temp_name3,"uploads_contributor/".$picname3);
    
    $query= "insert into contributorProfile values('$uid','$name','$mobile','$bus_name','$estd','$off_address','$city','$state','$off_mobile','$picname1','$picname2','$picname3')";
    mysqli_query($dbref,$query);
    $msg=mysqli_error($dbref);
      if($msg=="")
        header("location:result.php?msg=Your data has been SAVED successfully!");
   /* else
         echo $msg;*/
       
    
}
else/* update occur only afetr fetching current dtat, so update with json*/
{       
    $hdn1=$_POST["hdn1"];   
    $hdn2=$_POST["hdn2"];    
    $hdn3=$_POST["hdn3"];
    //hdn is id in profile code,from where this process file ka control coming
    
    if($picname1=="")
        $picname1=$hdn1;
     else
        move_uploaded_file($temp_name1,"uploads_contributor/".$picname1);
    
     if($picname2=="")
        $picname2=$hdn2;
    else
        move_uploaded_file($temp_name2,"uploads_contributor/".$picname2);
    
     if($picname3=="")
        $picname3=$hdn3;
    else
        move_uploaded_file($temp_name3,"uploads_contributor/".$picname3);
    
    //column names kept same as variable names in which store value from names/textbox
     $query= "update contributorProfile  set  
     name='$name',
     mobile='$mobile',
     bus_name='$bus_name',
     estd='$estd',
     off_address='$off_address',
     city='$city',
     state='$state',
     off_mobile='$off_mobile',
     pic1='$picname1',
     pic2 = '$picname2',
     pic3 ='$picname3'
     where uid='$uid'";
    
    /* where must  in the update query*/
    mysqli_query($dbref,$query);
    $msg=mysqli_error($dbref);
    if($msg=="")
        header("location:result.php?msg=Your data has been UPDATED successfully!");
  /*  else
        echo $msg;
       */
}
?>
