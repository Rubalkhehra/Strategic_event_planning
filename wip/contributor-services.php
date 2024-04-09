<?php
session_start();
if(!isset($_SESSION["uid"]))//so that if uid not there , cant go back
    header("location:index.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>contributor-services</title>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <style>
        body {
            background-image: url(pics/35.jpg);
        }

    </style>

    <script>
        $(document).ready(function() {

            loadFunctions(); //call this method automatically as apge loads

            function loadFunctions() //when call this on no id use document in ()
            {
                //  alert(aryJson.stringify());
                $.getJSON("json-fetch-cont-function.php", function(aryJson) {

                    for (i = 0; i < aryJson.length; ++i) //no need to declare i
                    {
                        var fun = document.createElement("option");
                        fun.text = aryJson[i].function;
                        //even though array  has only function prop ,need to mention explicitly as its json array and there is index also parallel to function
                        fun.value = aryJson[i].function;
                        document.getElementById("functions").append(fun); //must els eno list get
                        //writing in JS style!!!!!!!!!!!!!!!, so no $ before document
                    }
                });


            }
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            $("#functions").change(function() { //use # in jq before id


///////////////////********************** */
                var fun = $("#functions").val(); //getting value using jq
                var uid = $("#txtUid").val();
                $.getJSON("json-fetch-cont-services-existing.php?uid=" +  uid + "&functions=" + fun +, function(aryJson) {

                    alert(JSON.stringify(aryJson));

                    //get array of strings and that is only 1 object--also verify only 1  {}
                    // var arr=aryJson.split(";");--errror


                    // document.getElementById("service").length = 1; //id should match
                   

                    // document.getElementById("selservice").value = ""; //**********************


                    // var arr = aryJson[0].services.split(";");

                    // for (i = 0; i < arr.length; ++i) //no need to declare i
                    // {
                    //     var fun = document.createElement("option");
                    //     fun.text = arr[i];

                    //     fun.value = arr[i];
                    //     document.getElementById("service").append(fun); //must els eno list get
                    //     //writing in JS style!!!!!!!!!!!!!!!, so no $ before document
                    // }
                });
//////////////////************** */



                var fun = $("#functions").val(); //getting value using jq
                $.getJSON("json-fetch-cont-services.php?function=" + fun, function(aryJson) {
                    //key is function ,to be used in json while getting value    

                    // alert(JSON.stringify(aryJson));

                    //get array of strings and that is only 1 object--also verify only 1  {}
                    // var arr=aryJson.split(";");--errror


                    document.getElementById("service").length = 1; //id should match
                    //$("#service").length=1;----------not work????

                    document.getElementById("selservice").value = ""; //**********************


                    var arr = aryJson[0].services.split(";");

                    for (i = 0; i < arr.length; ++i) //no need to declare i
                    {
                        var fun = document.createElement("option");
                        fun.text = arr[i];

                        fun.value = arr[i];
                        document.getElementById("service").append(fun); //must els eno list get
                        //writing in JS style!!!!!!!!!!!!!!!, so no $ before document
                    }
                });
            });
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            //add items in selected services 
            $("#service").change(function() { //select
                //alert();
                var serv = $("#service").val();
                var selservice = $("#selservice").val();

                if (selservice.indexOf(serv) == -1)
                    $("#selservice").val(selservice + serv + ",");
                // $("#selservice").val( $("#selservice").val()+serv+",");  
                else
                    alert("Service already added!");
            });
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-    

            //saving data through ajax
            $("#save").click(function() { //$("#save").bind("click",function(){                  

                //need to save data via ajax and prevent to load new page,else it will become process file type save
                var uid = $("#txtUid").val();
                var fun = $("#functions").val();
                var selServ = $("#selservice").val();
                //remove last,

                /*substr vs substring    -------
                http://net-informations.com/js/iq/substr.htm
                --here get same result because length=last index
                */
                selServ = selServ.substring(0, selServ.length - 1);
                // selServ=selServ.substr(0,selServ.length-1);

                //  alert(selServ);

                if (fun == "none" || selServ.length == 0)
                    alert("Fill All Fields");
                else {
                   if (confirm("Are you sure to Save ?"))
                       {
                           $.get("ajax-contributor-services.php?uid=" + uid + "&functions=" + fun + "&selServices=" + selServ, function(response) {
                        alert(response);
                        //  $("#save").unbind("click");
                        // document.getElementById("selservice").value="";----empty text box on changing function,not on saving, so that contri ko agar dekhna hua, ki konkonsi services save ki hai usne, then not  good to clear on save

                    });
}
                    
                }


            });
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-    

        });

    </script>
</head>

<body>


    <!--to allow click only once  try bind---but need to refresh to disabkle once a button is unbind,even if add new function!!!!!!!!!!!!!!!!!!!! SO  make a query to insert only new value/-->
    <!--<input type="hidden" id="hdn" name="hdn" val="">-->
    <div class="container mt-3">
        <!--no form as no process file, need to save data through ajax-->

        <div class="col-md-8 offset-2">
            <!-- row-0 -->
            <div class="row text-center">
                <!--for spanning -->
                <h1 style="margin:auto;font-family:Times New Roman;padding:10px;text-shadow: 2px 2px 5px red">CONTRIBUTOR'S SERVICES</h1>
            </div>


            <!-- row 1 -->
            <div class="row mt-4">
                <div class="col-md-5 ">
                    <label for="txtUid">Username</label>
                    <input type="text" id="txtUid" name="txtUid" placeholder="Enter your username" class="form-control" value="<?php echo $_SESSION["uid"]?>" readonly required><!-- required when input type is submit--but here saving through ajax, so button is type, so use jquery validation-->
                </div>
            </div>



            <!-- row 2 -->
            <div class="row">
                <div class="col-md-5 ">
                    <!--form-row se size of box effected--try it-->

                    <label for="functions">Function </label>
                    <!--using functionsas id bcoz its keyword also-->
                    <select class="form-control " name="functions" id="functions">
                        <option value="none" name="" id="">Select</option>
                    </select>

                </div>

                <div class="col-md-5">
                    <div class="form-row">
                        <label for="service">Service </label>
                        <select class="form-control " name="service" id="service">
                            <option value="none" name="" id="">Select</option>
                        </select></div>
                </div>
            </div>
            <!-- row 3 -->
            <div class="row">
                <div class="col-md-12 ">
                    <label for="selservice">Selected Services</label>
                    <input type="text" id="selservice" name="selservice" placeholder="Selected services appear here" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <input type="button" id="save" name="save" class="btn btn-danger " value="Save" style="width:70px">
            </div>
        </div>
    </div>

</body>

</html>

<!--empty rext box on clicking save or changing fuction?-->
