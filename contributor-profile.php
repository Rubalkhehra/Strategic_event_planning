<!--*****************************************-->
<?php
session_start();
if(!isset($_SESSION["uid"]))//so that if uid not there , cant tgo back
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
            background: linear-gradient(to left, #ff9999 0%, #ffffff 114%);
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
        $(document).ready(function() {

            doFetch();

            function doFetch() {
                // $("#btnFetch").click(function() {
                var uid = $("#txtUid").val();
                $.getJSON("json-fetch-contributor-profile.php?uid=" + uid, function(aryJson) {

                    if (aryJson.length == 0) {
                        alert("No details available");
                        $("#btnSave").prop("disabled", false);
                        $("#btnUpdate").prop("disabled", true);
                        return;
                    }

                    $("#btnSave").prop("disabled", true);
                    $("#btnUpdate").prop("disabled", false);


                    //alert(aryJson);
                    //alert(JSON.stringify(aryJson));
                    /*data coming from db ,so use col anmes to fetch value*/
                    $("#txtUid").val(aryJson[0].uid);
                    $("#txtName").val(aryJson[0].name);
                    $("#txtMob").val(aryJson[0].mobile);
                    $("#txtOffMob").val(aryJson[0].off_mobile);
                    $("#txtBus").val(aryJson[0].bus_name);
                    $("#txtState").val(aryJson[0].state);
                    $("#txtOffAddress").val(aryJson[0].off_address);
                    $("#txtOcc").val(aryJson[0].occupation);
                    $("#txtCity").val(aryJson[0].city);
                    $("#txtEstd").val(aryJson[0].estd);
                    //passing value by using val fxn
                    $("#hdn1").val(aryJson[0].pic1);
                    $("#hdn2").val(aryJson[0].pic2);
                    $("#hdn3").val(aryJson[0].pic3);
                    //------pic upload 
                    var picReceived1 = aryJson[0].pic1; //getting value
                    $("#pic1").prop("src", "uploads_contributor/" + picReceived1);
                    var picReceived2 = aryJson[0].pic2; //getting value
                    $("#pic2").prop("src", "uploads_contributor/" + picReceived2);
                    var picReceived3 = aryJson[0].pic3; //getting value
                    $("#pic3").prop("src", "uploads_contributor/" + picReceived3);
                    //  alert("***");
                    //can ask for cinfirmation before ssving-change type-button from submit

                }); //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=
                // });

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
            $("#txtOffMob").blur(function() {
                var mob = $(this).val(); //fx, it returns the value
                var regEx = /^[6-9]{1}[0-9]{9}$/;
                if (mob.length == 0)
                    $("#errOffMob").html("Fill Mobile number").removeClass("ok").addClass("not-ok");
                else
                if (regEx.test(mob) == true)
                    $("#errOffMob").html("Valid ").removeClass("not-ok").addClass("ok");
                else
                    $("#errOffMob").html("Use 10 Numerics only!").removeClass("ok").addClass("not-ok");
            });
            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=- 

                    /*
                    Years from 1000 to 2999

                    ^[12][0-9]{3}$
                    
                    For 1900-2099
                    ^(19|20)\d{2}$
                    when use inclose in /  exp /
                    */
        $("#txtEstd").blur(function() {
                var mob = $(this).val(); //fx, it returns the value
                var regEx =/^(19|20)\d{2}$/;
                if (mob.length == 0)
                    $("#errEstd").html("Fill estd. year").removeClass("ok").addClass("not-ok");
                else
                if (regEx.test(mob) == true)
                    $("#errEstd").html("Valid ").removeClass("not-ok").addClass("ok");
                else
                    $("#errEstd").html("Invalid year").removeClass("ok").addClass("not-ok");
            });

            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-     
            $("#btnSave").click(function() { //before saving required will check all fields  are filled and this will check validity of data
                var mob = $("#txtMob").val();
                var name = $("#txtName").val();
                var mobOff = $("#txtOffMob").val();
                var regExMob = /^[6-9]{1}[0-9]{9}$/;
                var regExMobOff = /^[6-9]{1}[0-9]{9}$/;
                var regExName = /^[a-zA-Z ]*$/;
                 var state=$("#txtState").val();
                
                if(state=="none")
                     alert("CHOOSE STATE");

                else if (regExMob.test(mob) == false)
                    alert("FILl VALID MOBILE NUMBER");
                else if (regExMobOff.test(mob) == false)
                    alert("FILl VALID MOBILE NUMBER");

                else if (regExName.test(name) == false)
                    alert("FILl VALID NAME");

                else {
                    $("#btnSave").prop("type", "submit"); ///////////////////changed to button??????????????
                }
            });
            //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-     
            $("#btnUpdate").click(function() {
                var mob = $("#txtMob").val();
                var name = $("#txtName").val();
                var mobOff = $("#txtOffMob").val();
                var regExMob = /^[6-9]{1}[0-9]{9}$/;
                var regExMobOff = /^[6-9]{1}[0-9]{9}$/;
                var regExName = /^[a-zA-Z ]*$/;
                 var state=$("#txtState").val();
                
                if(state=="none")
                     alert("CHOOSE STATE");

                else if (regExMob.test(mob) == false)
                    alert("FILl VALID MOBILE NUMBER");
                else if (regExMobOff.test(mob) == false)
                    alert("FILl VALID MOBILE NUMBER");

                else if (regExName.test(name) == false)
                    alert("FILl VALID NAME");

                else {
                    $("#btnUpdate").prop("type", "submit"); ///////////////////changed to button??????????????
                }


            });

        });
        //-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-

    </script>
</head>

<body>
    <div class="container mt-1">

        <div class="row">
            <div class="col-md-12  text-center text-blak">
                <h1 style="margin:auto;font-family:Times New Roman;padding:10px;text-shadow: 2px 2px white">CONTRIBUTOR'S PROFILE</h1>
            </div>
        </div>
        <form action="contributor-profile-process.php" enctype="multipart/form-data" method="post">
            <div class="row mt-1">
                <!--main row-->
                <!-- col1 having details-->
                <div class="col-md-9 ">


                    <!-- enctype must to switch image-->

                    <!-- take hidden element in form-->
                    <input type="hidden" id="hdn1" name="hdn1" value="">
                    <input type="hidden" id="hdn2" name="hdn2" value="">
                    <input type="hidden" id="hdn3" name="hdn3" value="">

                    <!--row 1-->
                    <div class="form-row mt-1">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="txtUid">Username</label>
                                <input type="text" id="txtUid" name="txtUid" placeholder="Enter your username" class="form-control" readonly required value="<?php echo $_SESSION["uid"]; ?>">
                                <!--<small id="errUid" class="form-text text-primary">*</small>-->
                            </div>
                        </div>
                        <!-- <div class="col-md-2 form-group text-center">
                            <label for="btnFetch">&nbsp;</label>
                            <div id="btnFetch" name="btnFetch" class="form-control btn btn-danger" type="button" value="Fetch">Fetch
                                 type must else not work, without button also working???????????/
                            </div>
                        </div>-->
                    </div>

                    <!--row 2-->
                    <div class="form-row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtName">Name</label>
                                <input type="text" id="txtName" name="txtName" placeholder="Enter Name" class="form-control" required autocomplete="off">
                                <small id="errName" class="form-text text-primary">*</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtMob">Mobile</label>
                                <input type="text" id="txtMob" name="txtMob" placeholder="Enter 10 digit mobile numer" class="form-control" required autocomplete="off">
                                <small id="errMob" class="form-text text-primary">*</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtOffMob">Office number</label>
                                <input type="text" id="txtOffMob" name="txtOffMob" placeholder="Enter 10 digit mobile numer" class="form-control" required autocomplete="off" >
                                <small id="errOffMob" class="form-text text-primary">*</small>
                            </div>
                        </div>
                    </div>

                    <!--row 3-->
                    <div class="form-row ">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="txtBus">Business/Firm Name</label>
                                <input type="text" id="txtBus" name="txtBus" placeholder="Enter Businees/Firm name" class="form-control" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txtEstd">Estd. Year</label>
                                <input type="text" maxlength="4" id="txtEstd" name="txtEstd" placeholder="Enter year of estd." required autocomplete="off" class="form-control">
                                <small id="errEstd" class="form-text text-primary">*</small>

                            </div>
                        </div>
                    </div>

                    <!--row 4-->
                    <div class="form-row ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtOffAddress">Office Address</label>
                                <input type="text" id="txtOffAddress" name="txtOffAddress" placeholder="Enter Office Address" class="form-control" required autocomplete="off">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 ">
                            <div class="form-group">
                                <label for="txtCity">City</label>
                                <input type="text" id="txtCity" name="txtCity" placeholder="Enter City" class="form-control" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label for="txtState">State</label>
                                <select type="text" name="txtState" id="txtState" class="form-control" required>
                                    <option value="none">Select State</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Orissa">Orissa</option>
                                    <option value="Pondicherry">Pondicherry</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttaranchal">Uttaranchal</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <!-- row 5 -->
                    <div class="form-row mt-1 ">
                        <div class="col-md-12 ">
                            <div class="form-group text-center">
                                <!--<input type="submit" id="btnSave" name="btn" class="btn btn-danger" value="Save" style="width:80px">
                                <input type="submit" id="btnUpdate" name="btn" class="btn btn-danger " value="Update" style="width:80px"> -->
                                <!--since submit-so required work-->

                                <input type="button" id="btnSave" name="btn" class="btn btn-danger" value="Save" style="width:80px">
                                <input type="button" id="btnUpdate" name="btn" class="btn btn-danger " value="Update" style="width:80px">


                            </div>
                        </div>
                    </div>
                </div>

                <!-- gallery cols must be in form action -->
                <div class="col-md-3  ">
                    <!--border to see box-->
                    <div class="form-row text-center">
                        <div class="col-md-12 text-white">
                            <span style=" font-family:arial;font-size:30px">GALLERY</span>
                        </div>
                    </div>
                    <!--row 5-->
                    <!-- pic 1 -->
                    <div class="form-row ">
                        <div class="form-group text-center">
                            <img src="pics/pic-upload.jpg" height="120px" width="120" name="pic1" id="pic1">
                            <br>
                            <input type="file" id="ppic1" name="ppic1" accept="image/*" class="mt-1 " onchange="showpreview(this,pic1);">
                        </div>
                    </div>
                    <!-- pic 2 -->
                    <div class="form-row ">
                        <div class="form-group text-center">

                            <img src="pics/pic-upload.jpg" height="120px" width="120" name="pic2" id="pic2">
                            <br>
                            <input type="file" id="ppic2" name="ppic2" accept="image/*" class="mt-1 " onchange="showpreview(this,pic2);">
                        </div>
                    </div>
                    <!-- pic 3 -->
                    <div class="form-row ">
                        <div class="form-group text-center">

                            <img src="pics/pic-upload.jpg" height="120px" width="120" name="pic3" id="pic3">
                            <br>
                            <input type="file" id="ppic3" name="ppic3" accept="image/*" class="mt-1 " onchange="showpreview(this,pic3);">
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>


</body>

</html>
<!--row>col>form-row-->
