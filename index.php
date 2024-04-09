<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>index-signup-login</title>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .heading {
            margin: auto;
            font-family: Times New Roman;
            text-shadow: 2px 2px 5px gray;
            /*font-size: 40px;*/
            color: darkslategray;

        }

        body {
            background-color: darkslategrey;
            /*background-color: darkseagreen*/
            // background-image: linear-gradient(to right, #ada996, #f2f2f2, #dbdbdb, #eaeaea);
            /*   background-image: radial-gradient(circle, #ada996,#f2f2f2,#dbdbdb,#eaeaea);*/

        }

        .ok {
            color: green;
            font-size: 16px;
        }

        .not-ok {
            color: red;
            font-size: 14px;
        }

        .card-style {
            color: darkred;
            font-family: monospace;
            font-size: 26px;
            text-shadow: 0 0 4px red;
        }

        .logo {
            height: 60px;
            width: 60px;
            border-radius: 100%;
            transition: ease all 1s;
        }

        .logo:hover {
            transform: scale(1.5);
            transition: ease all 1s;
        }

        .bg-gradient-style {
            background-image: radial-gradient(#FFEFBA, #FFFFFF);
        }

        .table-color {
            background-image: linear-gradient(#F2F2F2, #DBDBDB, #EAEAEA);
        }

    </style>

    <!-- validations -->
    <script>
        $(document).ready(function() {

            $("#txtPwd").blur(function() {
                var pwd = $(this).val(); //fx, it returns the value
                var regEx = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
                if (pwd.length == 0)
                    $("#errPwd").html("Fill Password").removeClass("ok").addClass("not-ok");
                else if (regEx.test(pwd) == true)
                    $("#errPwd").html("Valid Password").removeClass("not-ok").addClass("ok");
                else
                    $("#errPwd").html("Use capital and small letters with numbers and special symbol").removeClass("ok").addClass("not-ok");
            });
            //=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-
            $("#txtMob").blur(function() {
                var mob = $(this).val(); //fx, it returns the value
                var regEx = /^[6-9]{1}[0-9]{9}$/;
                if (mob.length == 0)
                    $("#errMob").html("Fill Mobile number").removeClass("ok").addClass("not-ok");
                else
                if (regEx.test(mob) == true)
                    $("#errMob").html("Valid ").removeClass("not-ok").addClass("ok");
                else
                    $("#errMob").html("Use Numerics only!").removeClass("ok").addClass("not-ok");
            });


            //=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-        

            $('.carousel').carousel({
                interval: 3500
            });

        });


        //=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-        

    </script>

    <!--ajax -->
    <script>
        $(document).ready(function() {

            $("#txtUid").blur(function() {
                /* for ajax use jquery*/
                var uid = $("#txtUid").val();

                if (uid.length == 0) {
                    $("#errUid").html("Fill UserName").removeClass("ok").addClass("not-ok");
                    //alert("Fill UserName");
                    return;
                }

                $.get("ajax-check-uid.php?uid=" + uid, function(response) {
                    // alert(response);--fine
                    $("#errUid").html(response);
                    var uid = $("#txtUid").val(); //fx, it returns the value

                });
            });

            //=-=-=-=-=-=-=-=-=-=-==-=-=-=

            $("#signIn").click(function() {

                var uid = $("#txtUid").val();
                var pwd = $("#txtPwd").val();
                var mob = $("#txtMob").val();
                var cat = $("#txtCat").val();
                if (uid.length == 0 || pwd.length == 0 || mob.length == 0 || cat == "none")
                    alert("Fill all Fields");
                else { //pwd=md5(pwd);--not work in jq as its function of php
                    $.get("ajax-index-process-signin.php?uid=" + uid + "&pwd=" + pwd + "&mob=" + mob + "&cat=" + cat, function(response) //we can give any key
                        {
                            alert(response.trim()); //trim()removes all extra space leading to extra size of alert
                            //response is inbuilt ???????????  

                        });
                }

            });

            //=-=-=-=-=-=-=-=-=-=-==-=-=-=

            $("#login").click(function() {
                var uid = $("#txtUidLogin").val();
                var pwd = $("#txtPwdLogin").val();
                $.get("ajax-check-uid-pwd.php?uid=" + uid + "&pwd=" + pwd, function(response) {
                    //  alert("You are successfully logged in as "+response.trim());-if login wrong....then error
                    alert(response.trim());
                    //id not use response,trim()may give error
                    if (response.trim() == "client") //case of client matters as it is value, see from database value in db
                        location.href = "client-dashboard.php";
                    else if (response.trim() == "contributor") //used else if ,so that if login fails ,does not run this 
                        location.href = "contributor-dashboard.php";
                });
            });
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $("#admin").click(function() {
                var uid = $("#txtAdmLogin").val();
                var pwd = $("#txtPwdAdmLogin").val();
                $.get("ajax-login-admin.php?uid=" + uid + "&pwd=" + pwd, function(response) {
                    alert(response.trim());
                    location.href = "admin-dashboard.php";

                });
            });
        });

    </script>


</head>

<body>
    <!--navbar and buttons-->
    <!-- <div class="row"> this give scroll
        <div class="col-md-12">-->




    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand">
            <img src="pics/eventOrg2.png" width="50" height="40" class="logo" style="margin-left:0px;margin-top:-5px" alt="">
            <span class=" navbar-brand mb-0 h1 heading" style="color:darkslategray">
                <h1>EVENT ORGANISER</h1>
            </span></a>
        <form class="form-inline">

            <button class="btn btn-outline-dark my-2 my-sm-0" type="button" id="btnSignUp" name="btnSignUp" data-toggle="modal" data-target="#signUpModal">Sign Up</button><!-- value="Sign In"  no need-->

            <button class="btn btn-outline-dark my-2 my-sm-0" type="button" id="btnLogIn" name="btnLogIn" data-toggle="modal" data-target="#loginModal" style="margin-left:10px;">Login</button>

            <button class="btn btn-outline-dark my-2 my-sm-0" type="button" id="btnAdmin" name="btnAdmin" data-toggle="modal" data-target="#adminModal" style="margin-left:10px;">Admin</button>

        </form>
    </nav>


    <!--</div>
    </div>-->

    <div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <!-- corousel -->
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="7"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="8"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="9"></li>
                    </ol>
                    <div class="carousel-inner ">

                        <div class="carousel-item active">
                            <img src="pics/stagenew'.jpg" height="600" class="d-block w-100" alt="stagenew">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>First slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/weddingGarden.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/kitty2.jpg" height="600" class="d-block w-100" alt="kitty2">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/cards1.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/bdayMinions.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/jagran2big.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/tent1.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/tent2.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!--<h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>


                        <div class="carousel-item">
                            <img src="pics/bigcake.jpg" height="600" class="d-block w-100" alt="wedding Garden">
                            <div class="carousel-caption d-none d-md-block">
                                <!-- <h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                            </div>
                        </div>

                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    </div>

    <nav class="navbar navbar-light bg-light mt-1 mb-1">
        <span class="heading">
            <h1>OUR SERVICES</h1>
        </span>
    </nav>

    <!-- serivces card -->
    <div class=" container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mt-0">
                    <!-- card 1 -->
                    <div class="col-md-3 ">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <!-- give height to make size of all cards same-->
                            <img src="pics/wedMandal.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style">
                                <h1 class="card-style ">WEDDING</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like decoration, cards, tents, catering etc.</b> </p>
                            </div>
                        </div>
                    </div>

                    <!-- card 2 -->
                    <div class="col-md-3 ">
                        <div class="card border border-secondary img-thumbnail  mb-1" style="height:430px">
                            <!--style="width: 18rem;"-->
                            <img src="pics/ringCeremony.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style">
                                <h1 class="card-style ">RING CEREMONY</h1>
                                <p class="text-justify text-secondary " style="background-image:linear-gradient(to right, #FFEFBA,#FFFFFF;"><b> We have contributors providing services like decoration, flower service, hotel, catering etc.</b> </p>
                            </div>
                        </div>
                    </div>

                    <!-- card 3 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/bday1.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style">
                                <h1 class="card-style ">BIRTHDAY PARTY</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like decoration, confectionary, photographer, cards etc.</b></p>
                            </div>
                        </div>
                    </div>


                    <!-- card 4 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/jagran2big.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style">
                                <h1 class="card-style ">JAGRON</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like  flower decoration, mandli, pandal, cards, catering etc.</b> </p>
                            </div> 
                        </div>
                    </div>

                    <!-- card 5 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/bhog1.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style">
                                <h1 class="card-style ">BHOG</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like cards, tents, catering, dharamshala etc.</b> </p>
                            </div>
                        </div>
                    </div>

                    <!-- card 6 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/christmaseve1.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style ">
                                <h1 class="card-style ">CHRISTMAS EVE PARTY</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like decoration,catering etc.</b> </p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- card 7 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/collegefest.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style ">
                                <h1 class="card-style ">COLLEGE FEST</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like tents, decoration, lighting etc.</b> </p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- card 8 -->
                    <div class="col-md-3">
                        <div class="card border border-secondary img-thumbnail mb-1" style="height:430px">
                            <img src="pics/artExb1.jpg" class="card-img-top" height="220">
                            <div class="card-body  bg-gradient-style ">
                                <h1 class="card-style ">OUTDOOR ART EXHIBITION</h1>
                                <p class="text-justify text-secondary "><b> We have contributors providing services like deco , hanging tools etc.</b> </p>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                    
                    
                </div>
            </div>

        </div>
    </div>
    <!-- developers -->
   <nav class="navbar navbar-light bg-light mb-1">
        <span class="heading">
<!--            <h1>KNOW DEVELOPERS</h1>-->
       <h1>TEAM</h1>
        </span>
    </nav>


    <div class="container">
        <div class="row mb-1  mt-1">
            <!-- me -->
            
            <div class="col-md-6 bg-light border-right img-thumbnail   ">
                <div class="col-md-6 mt-2 offset-3 ">
<!--                    <img src="pics/meCrop.jpg" style="height:250px;width:250px; border:5px solid gray; border-radius:60%;">-->
               <img src="pics/userinfo2.png" style="height:250px;width:250px; border:5px solid gray; border-radius:60%;">
                </div>
                <div class="row mt-2">
                    <div class="col-md-10 offset-1">
                        <table class="table  text-dark border-bottom">
                            <tr>
                                <td><b>Name</b></td>
                                <td>Dishika Tayal</td>
                            </tr>
                            <tr>
                                <td><b>Student at</b></td>
                                <td>NIT, Jalandhar</td>
                            </tr>
                            <tr>
                                <td><b>Member Of</b></td>
                                <td>
                                    <ul>
                                        <li>Coding Club, NITJ</li>
                                        <li>DSC</li>
                                    </ul>
                                </td>

                            </tr>
                            <!--<tr>
                                    <td><b>Skills:</b></td>
                                    <td>
                                        <ul>
                                            <li>C</li>
                                            <li>C++</li>
                                            <li>Java</li>
                                            <li>Web Development</li>
                                        </ul>
                                    </td>
                                </tr>-->
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 bg-light img-thumbnail">
                <!-- sir -->
                <div class="col-md-6 mt-2  offset-3  ">
                    <img src="pics/userinfo2.png" style="height:250px;width:250px; border:5px solid gray; border-radius:60%;">
                </div>
                <div class="row mt-2">
                    <div class="col-md-10 offset-1">
                        <table class="table  text-dark border-bottom">
                            <tr>
                                <td><b>Name</b></td>
                                <td>Rubal Khehra</td>
                            </tr>
                            <tr>
                                <td><b>Student at</b></td>
                                <td>NIT, Jalandhar</td>
                            </tr>
                            <tr>
                                <td><b>Member Of</b></td>
                                <td>
                                    <ul>
                                        <li>Basketball Team NITJ</li>
<!--                                        <li></li>-->
                                    </ul>
                                </td>

                            </tr>
                            <!--          <tr>
                                    <td><b>Expert In:</b></td>
                                    <td>
                                        <ul>
                                            <li>Core and Advance Java </li>
                                            <li>Android, Spring, Hibernate</li>
                                            <li>PHP, AngularJS, Node.js</li>
                                            <li>C++</li>
                                        </ul>
                                    </td>
                                </tr>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- reach us -->
   <nav class="navbar navbar-light bg-light mb-1">
        <span class="heading">
            <h1>REACH US</h1>
       </span>
    </nav>


    <!-- maps -->
 <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6  ">
                        <center><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3405.652090675876!2d75.53316791391855!3d31.39615526040907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a51d30c180edf%3A0x5b7633718d17ef33!2sDr.+B.R.+Ambedkar+National+Institute+of+Technology!5e0!3m2!1sen!2sin!4v1563050899420!5m2!1sen!2sin"  frameborder="1px solid gray" style="border:1px solid white; " width="400" height="222"allowfullscreen></iframe></center>
                      
                    </div>
                    <div class="col-md-6 ">
                        <!-- keep page public! else not shown-->
                       <center> <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FEvent-Organiser-727002464420594%2F&tabs=timeline&width=400&height=222&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="400" height="222" scrolling="no"  frameborder="1px solid gray" style="border:1px solid white; " allowTransparency="true" allow="encrypted-media"></iframe></center>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--modals-->

    <!-- Sign up Modal -->

    <div class="modal fade" tabindex="-1" id="signUpModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Create your Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="">
                        <div class="form-group">
                            <label for="txtUid">Username</label>
                            <input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="Enter username" required autocomplete="off">
                            <small id="errUid" name="errUid">*</small>
                            <!--class="form-text text-muted-->
                        </div>
                        <div class="form-group">
                            <label for="txtPwd">Password</label>
                            <input type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="Enter  Password" required autocomplete="off">
                            <small id="errPwd" name="errPwd">*</small>
                            <!--class="form-text text-muted"--stop class change-->
                        </div>
                        <div class="form-group ">
                            <label for="txtMob">Mobile </label>
                            <input type="text" class="form-control" id="txtMob" name="txtMob" placeholder="Enter 10 digit Mobile number" maxlength="10" required autocomplete="off">
                            <small id="errMob" name="errMob">*</small>
                        </div>
                        <div class="form-group form-row ">
                            <!--//??????????????-->
                            <div class="col-md-4 ">
                                <label for="txtCat">Category </label>
                                <select class="form-control " name="txtCat" id="txtCat">
                                    <option value="none" name="" id="">Select</option>
                                    <option value="client" name="Client" id="client">Client</option>
                                    <option value="contributor" name="contributor" id="contributor">Contributor</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer  bg-light">
                    <button type="button" id="signIn" name="signIn" class="btn btn-secondary">Sign Up</button><!-- required autocomplete="off" work for submit buttons-->

                </div>
            </div>
        </div>
    </div>


    <!-- login Modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-light">
                    <h5 class="modal-title">Enter your Account details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="">
                        <div class="form-group">
                            <label for="txtUidLogin">Username</label>
                            <input type="text" class="form-control" id="txtUidLogin" name="txtUidLogin" placeholder="Enter username" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="txtPwdLogin">Password</label>
                            <input type="password" class="form-control" id="txtPwdLogin" name="txtPwdLogin" placeholder="Enter your Password" required autocomplete="off">
                        </div>

                    </form>

                </div>
                <div class="modal-footer  bg-light">
                    <button type="button" id="login" name="login" class="btn btn-secondary">Log In</button>
                    <!--<center><button type="submit" id="login" name="login" class="btn btn-secondary">Log In</button></center>error as  ajax ke saath dont use submit ,else new page load-->
                </div>
            </div>
        </div>
    </div>


    <!-- Admin Modal -->

    <div class="modal fade" id="adminModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-light">
                    <h5 class="modal-title">Enter Admin Account details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="">
                        <div class="form-group">
                            <label for="txtUidLogin">Admin ID</label>
                            <input type="text" class="form-control" id="txtAdmLogin" name="txtAdmLogin" placeholder="Enter username" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="txtPwdAdmLogin">Password</label>
                            <input type="password" class="form-control" id="txtPwdAdmLogin" name="txtPwdAdmLogin" placeholder="Enter your Password" required autocomplete="off">
                        </div>


                    </form>

                </div>
                <div class="modal-footer  bg-light">
                    <button type="button" id="admin" name="admin" class="btn btn-secondary">Admin Log In</button>
                    <!--<center><button type="submit" id="login" name="login" class="btn btn-secondary">Log In</button></center>error as  ajax ke saath dont use submit ,else new page load-->
                </div>
            </div>
        </div>
    </div>



</body>

</html>
