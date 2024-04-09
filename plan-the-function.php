<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>plan the function</title>
    <meta charset="UTF-8">

    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/angular.min.js"></script><!-- must be after jquery file-->
    <!--come below jquery file -->
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            /* background-image: url(pics/shooting-start.jpg);
            background-size: cover;
           */
            background-image: url(pics/star.webp);
        }

        .text-head {
            
            margin: auto;
            font-family: Times New Roman;            
            margin-top: 10px;
            /*??????????????????????????????*/
            color: white;
            text-shadow: 12px 12px 30px pink;

        }

    </style>

    <script>
        $(document).ready(function() {

            loadFunctions(); //call this method automatically as apge loads
            loadStates();
            //loadCities();

            function loadFunctions() //when call this on no id use document in ()
            {
                //  alert(aryJson.stringify());
                $.getJSON("json-fetch-plan-function.php", function(aryJson) {
                   // alert(aryJson)
                    //alert(aryJson.length)
                    for (i = 0; i < aryJson.length; ++i) {
                        var fun = document.createElement("option");
                        fun.text = aryJson[i].function;
                        fun.value = aryJson[i].function;
                        document.getElementById("functions").append(fun);
                    }
                });
            }
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            $("#functions").change(function() { //use # in jq before id

                // $("#serviceDiv").removeClass("hide").addClass("show");

                var fun = $("#functions").val(); //getting value using jq
                $.getJSON("json-fetch-plan-services.php?function=" + fun, function(aryJson) {

                    document.getElementById("service").length = 1;
                    var arr = aryJson[0].services.split(";");
                    arr.sort();
                    for (i = 0; i < arr.length; ++i) {
                        var fun = document.createElement("option");
                        fun.text = arr[i];
                        fun.value = arr[i];
                        document.getElementById("service").append(fun);
                    }
                });
            });

            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-  

            /* $("#service").change(function() {

                 $("#stateDiv").removeClass("hide").addClass("show");
                 loadStates();


             });*/
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-               

            function loadStates() {
                //may or not link states and function and services-----its good,need to just send function and services , but then the client cant select state before selecting function

                $.getJSON("json-fetch-plan-states.php", function(aryJson) {

                    for (i = 0; i < aryJson.length; ++i) {
                        var state = document.createElement("option");
                        state.text = aryJson[i].state;
                        state.value = aryJson[i].state;
                        document.getElementById("state").append(state);
                    }
                });
            }
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
            //function loadCities() {
            //to load cities of particular state only---better--must to selct state as city combo empty
            $("#state").change(function() {

                var state = $("#state").val();
                $.getJSON("json-fetch-plan-cities.php?state=" + state, function(aryJson) {

                    for (i = 0; i < aryJson.length; ++i) {
                        var city = document.createElement("option");
                        city.text = aryJson[i].city;
                        city.value = aryJson[i].city; //this aryJson is local
                        document.getElementById("city").append(city);
                    }
                });
            });
            //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

        });

    </script>

    <script>
        var Module = angular.module("myModule", []);
        Module.controller("myController", function($scope, $http) {
            
            
            
            $scope.doFetchCont = function() {
                $http.get("angular-fetch-all-contributors.php").then(fine, notfine);

                function fine(response) {
                    // $scope.aryJson;
                    // alert(JSON.stringify(response));//use capital JSON and not small**

                    $scope.aryJson = response.data;
                    // alert($scope.aryJson);
                    //console.log($scope.aryJson);
                }

                function notfine(respnonse) {
                    alert(JSON.stringify(respnonse));
                }
            }


            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $scope.doSearchNow = function() {

                //$("#default-card").prop("display","none");
                //$scope.aryJson=false;//hide pehle vvale cards-----removed from here because if click search without selecting all fiels- all cards disapperar
                var fun = $("#functions").val();
                var serv = $("#service").val();
                var state = $("#state").val();
                var city = $("#city").val();
                // if(fun==""||serv==""||state==""||city=="")//need to put as required work only in submit button tpe
                if (fun == "none" || serv== "none" || state== "none"|| city== "none") {
                    alert("FILL ALL FIELDS");
                }
                // alert("ok");
                else {
                    
                    $scope.aryJson=false;//hide pehle vvale cards
                    
                    $http.get("angular-fetch-contributors-plan.php?function=" + fun + "&service=" + serv + "&state=" + state + "&city=" + city).then(fine, notfine);

                    $scope.ArrayJson;

                    function fine(response) {
                        //alert(JSON.stringify(response)); //here get data , not in service vali file
                        $scope.ArrayJson = response.data;
                        // alert(JSON.stringify($scope.ArrayJson));
                    }

                    function notfine(response) {
                        alert(JSON.stringify(response));

                    }
                }

            }

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $scope.doShowOne = function(uid) {
                $http.get("json-fetch-contributor-profile.php?uid=" + uid).then(fine, notfine);

                // $scope.oneRecord;

                function fine(response) {
                    $scope.oneRecord = response.data;
                    // alert($scope.oneRecord);
                    $("#modal-details").modal("show");
                }

                function notfine(response) {
                    alert(JSON.stringify(response));
                }
            }
        });

    </script>

</head>

<body ng-app="myModule" ng-controller="myController" ng-init="doFetchCont();">

    <div class="container">

        <div class="row text-center ">
            <!--for spanning -->
            <h1 class="text-head">PLAN THE FUNCTION</h1>
        </div>

        <div class="col-md-12">
            <div class="row mt-5">

                <!-- col 1 menu -->
                <div class="col-md-3  border-right border-dark ">

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="functions"class="text-white">FUNCTION </label>
                            <select class="form-control " name="functions" id="functions" required>
                                <option value="none" name="" id="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4 " id="serviceDiv">
                        <!--//since this div is hidden ,so need to remove and add clas to this div, so give id to this div-->
                        <div class="col-md-12 ">
                            <!--earlier all are hidden-->
                            <label for="service" class="text-white">SERVICES </label>
                            <select class="form-control " name="service" id="service" required>
                                <option value="none" name="" id="">Select</option>
                            </select></div>
                    </div>

                    <div class="row mt-4 " id="stateDiv">
                        <div class="col-md-12">
                            <label for="state"class="text-white">STATE </label>
                            <select class="form-control " name="state" id="state" required>
                                <option value="none" name="" id="">Select</option>
                            </select></div>
                    </div>


                    <div class="row mt-4 " id="cityDiv">
                        <div class="col-md-12">
                            <label for="city"class="text-white">CITY </label>
                            <select class="form-control " name="city" id="city" required>
                                <option value="none" name="" id="">Select</option>
                            </select></div>
                    </div>

                    <div class="row mt-4 " id="searchDiv">
                        <div class="col-md-12">
                            <center>
                                <input type="button" id="search" name="search" class="btn btn-light " value="SEARCH NOW" ng-click="doSearchNow();"></center>
                        </div>
                    </div>
                </div>



                <!-- col 2 cards --copied from admin module -->
                
              
                <div class="col-md-9 ">
                    <div class="row">
                <!--=-=-=-=-=-=-=-=-=-=-=-=-=-=-default cards =-=-=-=-=-=-=-=-=-=-=-->         
                       
                       <div class="col-md-4 " ng-repeat="oneObj in aryJson" id="default-card">
                            <div class="card  mt-2 mb-2 border-white " style="height:350px;  background-image: linear-gradient(to right, #8e9eab,#eef2f3);">
                                <center>

                                    <a href="uploads_contributor/{{oneObj.pic1}}">
                                        <img src="uploads_contributor/{{oneObj.pic1}}" class="card-img-top " alt="profile pic" style="height:150px ; border:1px solid black;margin-bottom:10px"></a>
                                </center>

                                <!--  <div class="card-body "    style="  background-image: linear-gradient(to right, #11998e,#38ef7d);"> -->
                               <div class="card-body " style=" background-image: linear-gradient(to right, #8e9eab,#eef2f3);">
                                    <!-- <div class="card-body text-white" style="  background-image: linear-gradient(to right, #11998e,#38ef7d); ">
-->
                                    <center>
                                        <h5 class="card-title">{{oneObj.name}}</h5>
                                        
                                    </center>
                                    <h6 class="card-title text-justify">FIRM NAME : {{oneObj.bus_name}}</h6>

                                    <center>
                                        <div ng-click="doShowOne(oneObj.uid);" class="btn btn-light">DETAILS</div>
                                    </center>
                                </div>
                            </div>
                        </div>
                       
                       
                       
                         <!--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-->
                       
                       
                       
                       
                       
                        <div class="col-md-4 " ng-repeat="oneObj in ArrayJson">
                            <div class="card  mt-2 mb-2 border-white " style="height:350px;  background-image: linear-gradient(to right,#8e9eab,#eef2f3);">
                                <center>

                                    <a href="uploads_contributor/{{oneObj.pic1}}">
                                        <img src="uploads_contributor/{{oneObj.pic1}}" class="card-img-top mt-2" alt="profile pic" style="height:150px ; width:120px ; border:1px solid black;margin-bottom:10px"></a>
                                </center>

                                <!--  <div class="card-body "    style="  background-image: linear-gradient(to right, #11998e,#38ef7d);"> -->
                                <div class="card-body text-white" style="  background-image: linear-gradient(to right, #8e9eab,#eef2f3);">

                                    <center>
                                        <h5 class="card-title">{{oneObj.name}}</h5>
                                        <h6 class="card-title ">FIRM NAME : {{oneObj.bus_name}}</h6>
                                    </center>

                                    <center>
                                        <div ng-click="doShowOne(oneObj.uid);" class="btn btn-light">DETAILS</div>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <!--==-=-=-=-=-=-=-=-=-=-=-=-=MODAL DETAILS -==-=-=-=-=-=--->
                        <!-- Modal
                         -->

                        <div class="modal" id="modal-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaFbel" aria-hidden="true">
                            <!--from modal fade- remove-fade ,it alse speed a little-->
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">CONTRIBUTOR PROFILE</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-secondary table-hover">
                                            <tr>
                                                <th>NAME</th>
                                                <td>{{oneRecord[0].name}}</td>
                                            </tr>
                                            <tr>
                                                <th>MOBILE</th>
                                                <td>{{oneRecord[0].mobile}}</td>
                                            </tr>
                                            <tr>
                                                <th>BUSINESS</th>
                                                <td>{{oneRecord[0].bus_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>ESTD.</th>
                                                <td>{{oneRecord[0].estd}}</td>
                                            </tr>
                                            <tr>
                                                <th>OFFICE ADDRESS</th>
                                                <td>{{oneRecord[0].off_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>CITY</th>
                                                <td>{{oneRecord[0].city}}</td>
                                            </tr>
                                            <tr>
                                                <th>STATE</th>
                                                <td>{{oneRecord[0].state}}</td>
                                            </tr>
                                            <tr>
                                                <th>OFFICE MOBILE</th>
                                                <td>{{oneRecord[0].off_mobile}}</td>
                                            </tr>
                                            <tr>
                                                <th>PICS</th>
                                                <td>
                                                    <a href="uploads_contributor/{{oneRecord[0].pic1}}" target="_blank">
                                                        <img src="uploads_contributor/{{oneRecord[0].pic1}}" height="60" width="60" style="margin:5px">
                                                    </a>

                                                    <a href="uploads_contributor/{{oneRecord[0].pic2}}">
                                                        <img src="uploads_contributor/{{oneRecord[0].pic2}}" height="60" width="60" style="margin:5px">
                                                    </a>
                                                    <!--//will show error in inspect as we have not called the function and arrays are undefined-->
                                                    <a href="uploads_contributor/{{oneRecord[0].pic3}}">
                                                        <img src="uploads_contributor/{{oneRecord[0].pic3}}" height="60" width="60" style="margin:5px">
                                                    </a>

                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">SEND SMS</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
