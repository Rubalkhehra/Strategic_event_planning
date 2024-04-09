<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin-dashboard</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12 bg-dark text-white">
            <center><h1>Welcome to Admin's dashboard </h1></center>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <!--arrange all cards in a row-->

                    <!-- card 1  all contributor -->
                    <div class="card mt-2 mb-2 col-md-3 border-secondary bg-light">
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/userinfo2.png" class="card-img-top mt-2" alt="profile pic" style="height:120px ; width:120px ; border:1px solid black; border-radius:50%;"></center>
                        <div class="card-body">
                            <center> <h5 class="card-title">See all contributors</h5></center>
                            <!--<p class="card-text text-justify" >
                            <i>Welcome  Contributor!</i><br>
                        Thank you for logging in. We pride ourselves on offering our customers responsive, competent and excellent service. Our customers are the most important part of our business, and we work tirelessly to ensure your complete satisfaction, now and for as long as you are a customer</p>-->
                            <center> <a href="all-contributor-profile.php" class="btn btn-secondary border-secondary">ALL CONTRIBUTORS</a></center>
                        </div>
                    </div>

                    <!-- card 2 all clients-->
                    <div class="card mt-2 mb-2 col-md-3 offset-1 border-secondary bg-light">
                        <!--style="width: 18rem;margin-left:20px"-->
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/userinfo2.png" class="card-img-top mt-2" alt="profile pic" style="height:120px ; width:120px ; border:1px solid black; border-radius:50%;"></center>
                        <div class="card-body">
                           <center> <h5 class="card-title">See all clients</h5></center>
                            <!-- <p class="card-text text-justify" >
                            <i>Welcome  Contributor!</i><br>
                        Thank you for logging in. We pride ourselves on offering our customers responsive, competent and excellent service. Our customers are the most important part of our business, and we work tirelessly to ensure your complete satisfaction, now and for as long as you are a customer</p>-->
                            <center><a href="all-client-profile.php" class="btn btn-secondary border-secondary">ALL CLIENTS</a></center>
                        </div>
                    </div>


                    <!-- card 3 all users-->
                    <div class="card dark border-secondary  mt-2 mb-2 col-md-3 offset-1 bg-light">
                        <!--style="width: 18rem;margin-left:20px"-->
                        <!--style="width: 18rem;"-->
                        <center><img src="pics/userinfo2.png" class="card-img-top mt-2" alt="profile pic" style="height:120px ; width:120px ; border:1px solid black; border-radius:50%;"></center>
                        <div class="card-body">
                            <center><h5 class="card-title">See all users and edit</h5></center>
                            <!-- <p class="card-text text-justify" >
                            <i>Welcome  Contributor!</i><br>
                        Thank you for logging in. We pride ourselves on offering our customers responsive, competent and excellent service. Our customers are the most important part of our business, and we work tirelessly to ensure your complete satisfaction, now and for as long as you are a customer</p>-->
                            <center><a href="all-user-profile.php" class="btn btn-secondary border-secondary">AUTHENTICATION </a></center>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>



</body>

</html>
