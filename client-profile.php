<!--*****************************************-->
<?php
session_start();
if(!isset($_SESSION["uid"]))//so that if uid not there , cant go back
    header("location:index.php");
?>
<!--*****************************************-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>client-profile</title>
    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        body {
            /*#grad {*/
            /*background-image: linear-gradient(to right, rgb(227, 129, 129), rgb(222, 232, 132));*/
            /*background: linear-gradient(to right,#ddd6f3 ,#faaca8);*/
            background: linear-gradient(to bottom, #ddd6f3 0%, #faaca8 100%);
        }


        .ok {
            color: green;
            font-size: 16px;
        }

        .not-ok {
            color: red;
            font-size: 14px;
        }

    </style>

    <script>
        function showpreview(file, ref) {
            if ($(file)[0].files[0].size > 2097152) {
                alert("<=2 MB");
                return;
            }
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(ref).prop('src', e.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }
        }

    </script>

    <script>
        //Jquery
        /*******************************************/
        $(document).ready(function() {
            doFetch(); //call it as page loads

            // $("#btnFetch").click(function()
            function doFetch() {
                var uid = $("#txtUid").val();
                $.getJSON("json-fetch-client-profile.php?uid=" + uid, function(aryJson) {

                    if (aryJson.length == 0) {
                        alert("No Details Found!");
                        $("#btnSave").prop("disabled", false); //cant click on updtae if no data 
                        $("#btnUpdate").prop("disabled", true); //dont put double quotes
                    } else {
                        $("#btnSave").prop("disabled", true); //cant click on save if data filled once
                        $("#btnUpdate").prop("disabled", false);
                        // alert(aryJson);
                        // alert(JSON.stringify(aryJson));
                        /*data coming from db ,so use col anmes to fetch value*/
                        //  $("#txtUid").val(aryJson[0].uid);--after autofill no need
                        $("#txtName").val(aryJson[0].name);
                        $("#txtMob").val(aryJson[0].mobile);
                        $("#txtDob").val(aryJson[0].dob);
                        $("#txtAddress").val(aryJson[0].address);
                        $("#txtOcc").val(aryJson[0].occupation);
                        $("#txtCity").val(aryJson[0].city);
                        $("#txtEmail").val(aryJson[0].email);
                        $("#hdn").val(aryJson[0].pic); //passing value by using val fxn
                        //------pic
                        var picReceived = aryJson[0].pic; //getting value
                        $("#pic").prop("src", "uploads_client/" + picReceived);
                        //  alert("***");
                        //can ask for confirmation before ssving-change type-button from submit               
                    }

                });
            }
            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-
            $("#txtName").blur(function() {
                var uid = $(this).val(); //fx, it returns the value
                var regEx = /^[a-zA-Z ]*$/;

                if (uid.length == 0)
                    $("#errName").html("Fill Name").removeClass("ok").addClass("not-ok");
                else
                if (regEx.test(uid) == true)
                    $("#errName").html("Correct").removeClass("not-ok").addClass("ok");
                else {
                    $("#errName").html("Fill Valid Name").removeClass("ok").addClass("not-ok");
                }
            });


            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-     
            $("#txtMob").blur(function() {
                var mob = $(this).val(); //fx, it returns the value
                var regEx = /^[6-9]{1}[0-9]{9}$/;
                if (mob.length == 0)
                    $("#errMob").html("Fill Mobile number").removeClass("ok").addClass("not-ok");
                else
                if (regEx.test(mob) == true)
                    $("#errMob").html("Valid ").removeClass("not-ok").addClass("ok");
                else
                    $("#errMob").html("Use 10 Numerics only!").removeClass("ok").addClass("not-ok");
            });
            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-     
            $("#btnSave").click(function() {//before saving required will check all fields  are filled and this will check validity of data
                var mob = $("#txtMob").val(); 
                var name = $("#txtName").val(); 
                var regExMob = /^[6-9]{1}[0-9]{9}$/;
                var regExName = /^[a-zA-Z ]*$/;
                var occ=$("txtOcc").val();
                
                if(occ=="none")
                     alert("CHOOSE OCCUPATION");                              
                                
                else if (regExMob.test(mob) == false)
                   alert("FILl VALID MOBILE NUMBER");
                    
                else if (regExName.test(name) == false)
                   alert("FILl VALID NAME");  
                
                else
                    {
                        $("#btnSave").prop("type","submit");///////////////////changed to button??????????????
                    }
                    
                
            });
             //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-     
            $("#btnUpdate").click(function() {
                var mob = $("#txtMob").val(); 
                var name = $("#txtName").val(); 
                var regExMob = /^[6-9]{1}[0-9]{9}$/;
                var regExName = /^[a-zA-Z ]*$/;
                 var occ=$("txtOcc").val();
                
                if(occ=="none")
                     alert("CHOOSE OCCUPATION");                              
                                
                else if (regExMob.test(mob) == false)
                   alert("FILl VALID MOBILE NUMBER");
                    
                else if (regExName.test(name) == false)
                   alert("FILl VALID NAME");  
                
                else
                    {
                        $("#btnUpdate").prop("type","submit");///////////////////changed to button??????????????
                        /* required  still work*/
                    }
                    
                
            });
        });
        //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-

    </script>


</head>

<body>
    <div class="container ">

        <div class="row">
            <div class="col-md-12   text-center text-black">
                <h1 style="margin:auto;font-family:Times New Roman;padding:10px;text-shadow: 2px 2px 5px purple">CLIENT'S PROFILE</h1>
            </div>
        </div>

        <div class="row mt-1">
            <!--main row-->
            <div class="col-md-10 offset-1 border">

                <form action="client-profile-process.php" enctype="multipart/form-data" method="post">
                    <!-- enctype must to switch image-->

                    <!-- take hidden element in form-->
                    <input type="hidden" id="hdn" name="hdn" value="0">

                    <!--row 1-->
                    <div class="form-row mt-1">
                        <div class="col-md-5">
                            <!--form group????/-->
                            <div class="form-group">
                                <label for="txtUid">Username</label>
                                <!--************************************-->
                                <input type="text" id="txtUid" name="txtUid" placeholder="Enter your username" class="form-control" readonly value="<?php echo $_SESSION['uid'];?> ">
                                <!--************************************-->

                            </div>
                        </div>

                        <!--  <div class="col-md-2 form-group text-center">
                            <label for="btnFetch">&nbsp;</label>
                            <div id="btnFetch" name="btnFetch" class="form-control btn btn-danger" type="button" value="Fetch">
                ------------Fetch type must else not work, without button also working???????????/
                            </div>
                        </div>-->


                    </div>

                    <!--row 2-->
                    <div class="form-row ">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="txtName">Name</label>
                                <input type="text" id="txtName" name="txtName" placeholder="Enter Name" class="form-control" required autocomplete="off">
                                <small id="errName" class="form-text ">*</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtMob">Mobile</label>
                                <input type="text" id="txtMob" name="txtMob" placeholder="Enter 10 digit mobile numer" class="form-control" required autocomplete="off">
                                <small id="errMob" class="form-text ">*</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txtDob">DOB</label>
                                <input type="date" id="txtDob" name="txtDob" class="form-control" required autocomplete="off">
                                <!-- <small id="errMob" class="form-text ">*</small>-->
                            </div>
                        </div>
                    </div>

                    <!--row 3-->
                    <div class="form-row ">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="txtAddress">Address</label>
                                <input type="text" id="txtAddress" name="txtAddress" placeholder="Enter Address" class="form-control" required autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtCity">City</label>
                                <input type="text" id="txtCity" name="txtCity" placeholder="Enter City" class="form-control" required autocomplete="off">

                            </div>
                        </div>
                    </div>

                    <!--row 4-->
                    <div class="form-row ">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="txtEmail">email-id</label>
                                <input type="email" id="txtEmail" name="txtEmail" placeholder="Enter email-id" class="form-control" required autocomplete="off">
                                <!--type -email,check needed format-->

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtOcc">Occupation</label>
                                <select class="form-control " name="txtOcc" id="txtOcc" required>
                                    <option value="none" name="" id="">--Select--</option>
                                    <option value="job" name="job" id="job">Job</option>
                                    <option value="business" name="business" id="business">Business</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--row 5-->
                    <div class="form-row ">
                        <div class="col-md-6 offset-3">
                            <div class="form-group text-center">

                                <!--form group-->
                                Profile pic:<br>
                                <img src="pics/userinfo.png" height="120px" width="120" name="pic" id="pic">
                                <br>
                                <input type="file" id="ppic" name="ppic" accept="image/*" class="mt-1 " onchange="showpreview(this,pic);">
                            </div>
                        </div>
                    </div>

                    <!-- row 6 -->
                    <div class="form-row mt-1 ">
                        <div class="col-md-12 ">
                            <div class="form-group text-center">
                                <!--<input type="submit" id="btnSave" name="btn" class="btn btn-danger" value="Save" style="width:80px">
                                <input type="submit" id="btnUpdate" name="btn" class="btn btn-danger " value="Update" style="width:80px">-->     <!--can use requred-->
                                  <input type="button" id="btnSave" name="btn" class="btn btn-danger" value="Save" style="width:80px">
                                <input type="button" id="btnUpdate" name="btn" class="btn btn-danger " value="Update" style="width:80px">
                                
                                
                                
                                
                           


                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

</body>

</html>
