<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>all-client-profile</title>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script>
        var Module = angular.module("myModule", []);
        Module.controller("myController", function($scope, $http) {
            //http must to use ajax/json 

           // $scope.aryJson;
            $scope.doFetchClient = function() {
                $http.get("angular-fetch-all-clients.php").then(fine, notfine);

                function fine(response) {
                    // $scope.aryJson;
                    //alert(JSON.stringify(response.data)); //use capital JSON and not small**
                    $scope.aryJson = response.data;
                }

                function notfine(respnonse) {
                    //alert(JSON.stringify(respnonse));
                }
                //-=-=-=-=-=--=-=-=-=-=-=-=-=-=-= 
            }
            //-=-=-=-=-=--=-=-=-=-=-=-=-=-=-= 
            $scope.doShowOne = function(uid) {
                //alert(uid);
                $http.get("json-fetch-client-profile.php?uid=" + uid).then(fine, notfine);

                function fine(response) {
                    $scope.oneRecord = response.data;
                    //alert($scope.oneRecord);
                    $("#modal-details").modal("show");
                }

                function notfine(response) {
                    $scope.oneRecord = response.data;
                }

            }
        });

    </script>

</head>

<body ng-app="myModule" ng-controller="myController" ng-init="doFetchClient();">
    <div class="container mt-1">
        <div class="row mb-2">
            <div class="col-md-12 bg-secondary text-white font-weight-bolder text-center" style="font-size:28px">
                ALL CLIENTS
            </div>
        </div>


        <table class="table table-striped table-bordered table-hover bg-light">
            <tr align=center>
                <th>NAME</th>
                <th>MOBILE</th>
                <th>DATE OF BIRTH</th>
                <th>ADDRESS</th>
                <th>CITY</th>
                <th>E-MAIL</th>
                <th>OCCUPATION</th>
                <th>PIC</th>
            </tr>

            <tr ng-repeat="oneObj in aryJson">

                <td>{{oneObj.name}}</td>
                <td>{{oneObj.mobile}}</td>
                <td>{{oneObj.dob}}</td>
                <td>{{oneObj.address}}</td>
                <td>{{oneObj.city}}</td>
                <td>{{oneObj.email}}</td>
                <td>{{oneObj.occupation}}</td>
                <td>
                    <a href="uploads_client/{{oneObj.pic}}" target="_blank">
                        <img src="uploads_client/{{oneObj.pic}}" height="60" width="60" style="margin:5px">
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
                            <center><img src="uploads_client/{{oneRecord.pic}}" class="card-img-top mt-2" alt="profile pic" style="height:120px ; width:120px ; border:1px solid black;"></center>
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

                            <a href="uploads_client/{{oneObj.pic}}">
                                <img src="uploads_client/{{oneObj.pic}}" class="card-img-top mt-2" alt="profile pic" style="height:150px ; width:120px ; border:1px solid black;margin-bottom:10px"></a></center>
                        <div class="card-body bg-light">
                            <center>
                                <h5 class="card-title">{{oneObj.name}}</h5>
                            </center>
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
                                <h5 class="modal-title" id="exampleModalLabel">CLIENT PROFILE</h5>
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
                                        <th>DATE OF BIRTH</th>
                                        <td>{{oneRecord[0].dob}}</td>
                                    </tr>

                                    <tr>
                                        <th>ADDRESS</th>
                                        <td>{{oneRecord[0].address}}</td>
                                    </tr>
                                    <tr>
                                        <th>CITY</th>
                                        <td>{{oneRecord[0].city}}</td>
                                    </tr>
                                    <tr>
                                        <th>E-MAIL</th>
                                        <td>{{oneRecord[0].email}}</td>
                                    </tr>

                                    <tr>
                                        <th>OCCUPATION</th>
                                        <td>{{oneRecord[0].occupation}}</td>
                                    </tr>
                                    <tr>
                                        <th> PROFILE PIC</th>
                                        <td>
                                            <a href="uploads_client/{{oneRecord[0].pic}}" target="_blank">
                                                <img src="uploads_client/{{oneRecord[0].pic}}" height="60" width="60" style="margin:5px">
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </div>


        </details>






    </div>



</body>

</html>
