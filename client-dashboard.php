<!--***********************************-->
<?php
session_start();
if(!isset($_SESSION["uid"]))
    header("location:index.php");
?>
<!--***********************************-->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>client-dashboard</title>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            background-image: url(pics/black-sky.jpg);
        }

    </style>

</head>


<body>


    <div class="container">

        <div class="row">
            <div class="col-md-12  ">
                <!--<h1>Welcome to Client's dashboard</h1>-->

                <!--***********************************-->
                <center>
                    <h1 style="color:white">Welcome
                        <?php 
                echo "<i> <span style='color:red ;text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>

                        to Client's dashboard
                    </h1>
                </center>
                <!--***********************************-->
            </div>
        </div>


<div class="container">  <div class="row">
            <div class="col-md-12 ">
                <!-- card 1 client -->
                <div class="form-row">

                    <div class="card mt-2 mb-2 col-md-3 bg-light border-white">
                        <!-- style="height:480px" give height or put breaks to make size of card same-->
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/userinfo2.png" class="card-img-top " alt="profile pic" style="height:200px ; width:180px ; border:1px solid black;border-radius:50%;"></center>
                        <div class="card-body">
                            <h5 class="card-title">Client's Profile</h5>
                            <p class="card-text text-justify text-justify">
                                <i>Welcome <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Thank you for logging in. We pride ourselves on offering our customers responsive, competent and excellent service.
                                <!-- Our customers are the most important part of our service, and we work tirelessly to ensure your complete satisfaction, now and for as long as you are a customer.-->
                            </p>
                            <br>
                            <a href="client-profile.php" class="btn btn-secondary">Edit Profile</a>

                        </div>
                    </div>



                    <!-- card 3 -->

                    <!-- logout card -->
                    <!-- <div class="card mt-2 bg-light mb-2" style="width: 18rem;">-->
                    <div class="card mt-2 mb-2 col-md-3 bg-light border-white offset-1">
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/function.jpg" class="card-img-top " alt="profile pic" style="height:200px  ;">
                            <!--border-radius:50%;-->
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Plan a function</h5>
                            <p class="card-text text-justify text-justify text-justify">
                                <i>Dear <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Thank you for logging in.
                                <br>Click on the button to plan the function and find contributors in your city accordingly.

                                We wish you happy surfing and hope for a successful event planning. </p>
                            <a href="plan-the-function.php" class="btn btn-secondary">Search Services</a>
                        </div>
                    </div>


                    <!-- logout card -->
                    <!-- <div class="card mt-2 bg-light mb-2" style="width: 18rem;">-->
                    <div class="card mt-2 mb-2 col-md-3 bg-light border-white offset-1">
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/logout.jpg" class="card-img-top " alt="profile pic" style="height:200px ; ">
                            <!--border-radius:50%;-->
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Logout</h5>
                            <p class="card-text text-justify text-justify">
                                <i>Thank You <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Hope you enjoyed planning your function on our Website!<br>
                                Hope to see you back soon.<br>
                                We will be obliged by your feedback.
                                <!--feedback???????????-->
                            </p>
                            <br>
                            <a href="logout.php" class="btn btn-secondary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      

    </div>




</body>

</html>
