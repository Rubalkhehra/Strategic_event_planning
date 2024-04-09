<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>all-USERS-profile</title>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        var Module = angular.module("myModule", []);

        Module.controller("myController", function($scope, $http) {
            
            //-=-=-=-=-=-=-=-==-=-==-=-=-=-=-=-=
            $scope.doFetchUsers = function() {
                //  alert("ok1");
                $http.get("angular-all-fetch-users.php").then(fine, notfine);

                function fine(response) {
                    $scope.aryJson = response.data;
                    //alert($scope.aryJson);
                }

                function notfine(response) {
                    $scope.aryJson = response.data;
                    alert(JSON.stringify(response));
                }
            }
            //-=-=-=-=-=-=-=-==-=-==-=-=-=-=-=-=
            $scope.doRemove=function(uid){
                if(confirm("Do you want to remove the user permanently?"))
                    {
                        $http.get("angular-remove-user-by-admin.php?uid="+uid).then(fine,notfine);
                function fine(response) {
                    $scope.aryJson = response.data;
                    doFetchUsers();
                    //alert($scope.aryJson);
                }

                function notfine(response) {
                    $scope.aryJson = response.data;
                    alert(JSON.stringify(response));
                }
                    }
                
            }

        });

    </script>


</head>

<body ng-app="myModule" ng-controller="myController" ng-init="doFetchUsers();">
    <div class="container mt-1">
        <div class="row mb-2">
            <div class="col-md-12 bg-info text-white font-weight-bolder text-center" style="font-size:28px">
                ALL USERS
            </div>
        </div>


        <table class="table  table-bordered table-info  table-hover">
            <tr align=center style="background-color:cadetblue">
                <th>USERNAME</th>
                <th>MOBILE</th>
                <th>CATEGORY</th>
                <th>REMOVE</th>
            </tr>
            <tr align="center" ng-repeat="oneObj in aryJson">
                <td>{{oneObj.uid}}</td>
                <td>{{oneObj.mobile}}</td>
                <td>{{oneObj.category}}</td>
                <td>
                    <div class="btn" style="background-color:cadetblue" ng-click="doRemove(oneObj.uid);">Remove</div>
                </td>
            </tr>
        </table>








    </div>



</body>

</html>
