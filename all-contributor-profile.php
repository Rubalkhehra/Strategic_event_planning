<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>all-contributor-profile</title>
    <title>index-signup-login</title>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script>
        var Module = angular.module("myModule", []);
        Module.controller("myController", function($scope, $http) {
            //http must to use ajax/json 

            $scope.aryJson;
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
                //-=-=-=-=-=--=-=-=-=-=-=-=-=-=-= 
            }
            //-=-=-=-=-=--=-=-=-=-=-=-=-=-=-= 
            $scope.doShowOne = function(uid) {


                //alert(uid);
                $http.get("json-fetch-contributor-profile.php?uid=" + uid).then(fine, notfine);

                function fine(response) {

                    $scope.oneRecord = response.data;
                    //  alert( $scope.oneRecord);
                    $("#modal-details").modal("show");

                }

                function notfine(response) {
                    $scope.oneRecord = response.data;

                }

            }
        });

    </script>

</head>

<body ng-app="myModule" ng-controller="myController" ng-init="doFetchCont();">
    <div class="container mt-1">
        <div class="row mb-2">
            <div class="col-md-12 bg-secondary text-white font-weight-bolder text-center" style="font-size:28px">
                ALL CONTRIBUTORS
            </div>
        </div>


        <table class="table table-striped table-bordered table-hover bg-light">
            <tr align=center>
                <th>NAME</th>
                <th>MOBILE</th>
                <th>BUSINESS NAME</th>
                <th>ESTD.</th>
                <th>OFFICE ADDRESS</th>
                <th>CITY</th>
                <th>STATE</th>
                <th>OFFICE MOBILE</th>
                <th>PICS</th>
            </tr>

            <tr ng-repeat="oneObj in aryJson">

                <td>{{oneObj.name}}</td>
                <td>{{oneObj.mobile}}</td>
                <td>{{oneObj.bus_name}}</td>
                <td>{{oneObj.estd}}</td>
                <td>{{oneObj.off_address}}</td>
                <td>{{oneObj.city}}</td>
                <td>{{oneObj.state}}</td>
                <td>{{oneObj.off_mobile}}</td>
                <td>
                    <a href="uploads_contributor/{{oneObj.pic1}}" target="_blank">
                        <img src="uploads_contributor/{{oneObj.pic1}}" height="60" width="60" style="margin:5px">
                    </a>

                    <a href="uploads_contributor/{{oneObj.pic2}}">
                        <img src="uploads_contributor/{{oneObj.pic2}}" height="60" width="60" style="margin:5px">
                    </a>

                    <a href="uploads_contributor/{{oneObj.pic3}}">
                        <img src="uploads_contributor/{{oneObj.pic3}}" height="60" width="60" style="margin:5px">
                    </a>

                </td>

            </tr>
        </table>


        <details>
            <summary>See in Grid</summary>

            <!--<div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="card mt-2 mb-2 col-md-3 " ng-repeat="oneRecord in aryJson">
                            style="width: 18rem;"
                            <center><img src="uploads_contributor/{{oneRecord.pic1}}" class="card-img-top mt-2" alt="profile pic" style="height:120px ; width:120px ; border:1px solid black;"></center>
                            <div class="card-body">
                            <center><h5 class="card-title">{{oneRecord.name}}</h5></center>
                              
                                <center> <a href="all-contributors-profile.php" class="btn btn-primary">ALL CONTRIBUTORS</a></center>
                            </div>
                        </div>
                    </div>
                </div>
                -->

            <div class="row">
                <div class="col-md-3 " ng-repeat="oneObj in aryJson">
                    <!--giving width to co-gives automatic spacr in cards-->

                    <div class="card  mt-2 mb-2 border-dark ">
                        <!--border border-primary-->
                        <!--style="width: 18rem;"-->
                        <center>

                            <a href="uploads_contributor/{{oneObj.pic1}}">
                                <img src="uploads_contributor/{{oneObj.pic1}}" class="card-img-top mt-2" alt="profile pic" style="height:150px ; width:120px ; border:1px solid black;margin-bottom:10px"></a></center>
                        <div class="card-body bg-light">
                            <center>
                                <h5 class="card-title">{{oneObj.name}}</h5>
                                <h6 class="card-title">FIRM NAME : {{oneObj.bus_name}}</h6>
                            </center>
<!--
                            <center> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-details" ng-click="doShowOne(oneObj.uid);"></button>-->
                                    
                                <!--</button></center> data baad mein ayega and modal pehl khul jayega--so do as in next way-->
                            <center>
                                <div ng-click="doShowOne(oneObj.uid);" class="btn btn-secondary">DETAILS</div>
                                <!--pass uid and not name-->
                            </center>
                        </div>
                    </div>
                </div>

                <!--==-=-=-=-=-=-=-=-=-=-=-=-=MODAL DETAILS -==-=-=-=-=-=--->
                <!-- Modal -->
                <div class="modal" id="modal-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


        </details>






    </div>



</body>

</html>
