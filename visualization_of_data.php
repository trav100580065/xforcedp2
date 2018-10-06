<!DOCTYPE html>
<html ng-app="plunker">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="JJ" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <script>document.write('<base href="' + document.location + '" />');</script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.js"></script>
    <script src="https://rawgit.com/krispo/angular-nvd3/v1.0.5/dist/angular-nvd3.js"></script>
    <script src="js/app.js"></script>
</head>
<!--<body data-ng-controller="maApp">-->


<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
    die("Connection failed: " . mysqli_connect_error());
    echo "<p>Database connection failure</p>";
}

$products_set = find_all_products($db);

//$data = array();
$product_name = array();
$alldata = array();
//display the retrieved records
while($row = mysqli_fetch_assoc($products_set)){
    $data = array();
    $data[] = $row["productName"];
    $data[] = (int)$row["price"];
    $alldata[] = $data;
}


print_r($alldata);

?>
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
                    top: 20,
                    right: 50,
                    bottom: 150,
                    left: 55
                },
                x: function(d){return d[0];},
                y: function(d){return d[1];},
                showValues: true,
                duration: 500,
                xAxis: {
                    axisLabel: 'X Axis',
                    rotateLabels: 45
                },
                yAxis: {
                    axisLabel: 'Price',
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




</html>
