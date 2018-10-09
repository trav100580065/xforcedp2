<!DOCTYPE html>
<html lang="en" ng-app="plunker">

<head>
  <?php
  require_once('database.php');
  require_once('query_functions.php');

  //connect to database
  $db = db_connect();

  if(!$db){
    die("Connection failed: " . mysqli_connect_error());
    echo "<p>Database connection failure</p>";
  }

   ?>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="..." />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>document.write('<base href="' + document.location + '" />');</script>
    <!--    <link rel="stylesheet" href="style.css" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.js"></script>
    <script src="https://rawgit.com/krispo/angular-nvd3/v1.0.5/dist/angular-nvd3.js"></script>
</head>

<header>
    <h1>Welcome to People Health Pharmacy</h1>
</header>

<body>
    <div class="container">
      <div class="panel-body">

        <div class="row">
          <h2 class="centered">Generate Prediction Report</h2>
        </div>

        <div class="col-xs-6 col-xs-offset-3">
          <a class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-3" href="index.html">Back</a>
        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="col-md-6">
              <?php

              $alldata = find_prediction_results($db);
              db_disconnect($db);
              ?>
            </div>

            <!--VISUALIZATION OF REPORT-->

            <div ng-controller="MainCtrl">
                <nvd3 options="options" data="data"></nvd3>


                <script>
                    var app = angular.module('plunker', ['nvd3']);

                    app.controller('MainCtrl', function($scope) {
                        $scope.options = {
                            chart: {
                                type: 'discreteBarChart',
                                height: 450,
                                margin : {
                                    top: 50,
                                    right: 50,
                                    bottom: 150,
                                    left: 55
                                },
                                x: function(d){return d[0];},
                                y: function(d){return d[1];},
                                showValues: true,
                                duration: 500,
                                xAxis: {
                                    axisLabel: 'Product Name',
                                    rotateLabels: 45
                                },
                                yAxis: {
                                    axisLabel: 'Total Quantity',
                                    axisLabelDistance: -10
                                }
                            }
                        };
                        $scope.data = [
                            {
                                "key" : "Quantity" ,
                                // "bar": true,
                                "values" : <?php echo json_encode($alldata);?>
                            }];
                    });

                </script>

            </div>
          </div>
        </div>
      </div>


    </div>
</body>
</html>
