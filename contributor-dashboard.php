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
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>contributor-dashboard</title>

    <style>
        body {
            background-image: url(pics/garland.jpg);
            opacity: .8;
        }

    </style>

</head>

<body>


    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <!--<h1>Welcome to Contributor's dashboard </h1>-->
                <!--***********************************-->
                <center>
                    <h1>Welcome

                        <?php 
                echo "<i> <span style='color:red ;text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>

                        to Contributor's dashboard
                    </h1>
                </center>
                <!--***********************************-->
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 ">
                <div class="form-row">
                    <!--arrange all cards in a row-->
                    <!-- card 1 contributor -->
                    <div class="card mt-2 mb-2 col-md-3 bg-light border-danger">
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/userinfo2.png" class="card-img-top " alt="profile pic" style="height:200px ; width:180px ; border:1px solid black;border-radius:50%;"></center>
                        <div class="card-body">
                            <h5 class="card-title">Contributor's Profile</h5>
                            <p class="card-text text-justify text-justify">
                                <i>Welcome <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Thank you for logging in.
                                <br>Your contribution is unique, and this is the meaning and value of your individuality.<br>We wish you have plenty of clients. </p>

                            <a href="contributor-profile.php" class="btn btn-secondary">Edit Profile</a>
                        </div>
                    </div>

                    <!-- card 2 contributor -->
                    <div class="card mt-2 mb-2 col-md-3 bg-light border-danger offset-1">
                        <!--style="width: 18rem;margin-left:20px"-->
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/catering.jpg" class="card-img-top " alt="profile pic" style="height:200px;"></center>
                        <div class="card-body">
                            <h5 class="card-title">Enter your services</h5>
                            <p class="card-text text-justify">
                                <i>Dear <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Thank you for logging in.
                                <br>Click on the button to enter your function and services in your city so that a cient can find you.
                                We hope for a successful event planning. </p>

                            <a href="contributor-services.php" class="btn btn-secondary">Enter Services</a>
                        </div>
                    </div>




                    <!-- card 3 contributor -->
                    <div class="card mt-2 mb-2 col-md-3 bg-light border-danger offset-1">
                        <!--style="width: 18rem;margin-left:20px"-->
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/logout.jpg" class="card-img-top " alt="profile pic" style="height:200px ; ">
                            <!--border-radius:50%;-->
                        </center>
                        <div class="card-body">
                            <h5 class="card-title">Logout</h5>
                            <p class="card-text text-justify">
                                <i>Thank You <?php 
                echo "<i> <span style='text-transform:capitalize'>".$_SESSION["uid"]."</span></i>";
            ?>!</i><br>
                                Hope you enjoyed entering your contributions in our Website!<br>
                                Hope to see you back soon.<br>
                                We will be obliged by your feedback.</p> <a href="logout.php" class="btn btn-secondary"> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
