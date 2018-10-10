<?php
session_start();
require_once('database.php');
require_once('query_functions.php');
$db = db_connect();

if(!$db){
    die("Connection failed: " . mysqli_connect_error());
    echo "<p>Database connection failure</p>";
}
else{

    if(isset($_POST["btnExport"])){
        $sales_set = find_monthly_sales($db, $_SESSION['endDate'], $_SESSION['productName']);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=sales.csv');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        $csvoutput = fopen('php://output','w');

        $row = get_row($sales_set);
        $headers = array_keys($row);
        fputcsv($csvoutput, $headers);
        fputcsv($csvoutput, $row);
        while($row = get_row($sales_set)){
            fputcsv($csvoutput, $row);
        }
        fclose($csvoutput);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="plunker">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="Cyrus" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>document.write('<base href="' + document.location + '" />');</script>
    <!--    <link rel="stylesheet" href="style.css" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.js"></script>
    <script src="https://rawgit.com/krispo/angular-nvd3/v1.0.5/dist/angular-nvd3.js"></script>
</head>
<body>
<div class="container">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li><a href="monthly_report.php">Back</a></li>
        </ul>
    </div>
    <form method="post" action="mthProcess.php">
        <input type="submit" name="btnExport" value="CSV Export" class="btn btn-success" />
    </form>
    <br />
    <h3>Monthly Sales Report</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once('database.php');
        require_once('query_functions.php');

        $db = db_connect();

        if(!$db){
            die("Connection failed: " . mysqli_connect_error());
            echo "<p>Database connection failure</p>";
        }
        else{
            $endDate = $_POST['endDate'];
            $productName = $_POST['select'];

            // save end date and product name in session variables
            $_SESSION['endDate'] = $endDate;
            $_SESSION['productName'] = $productName;

            $sales_set = find_monthly_sales($db, $endDate, $productName);

            //display the retrieved records
            while($row = mysqli_fetch_assoc($sales_set)){
                $data = array();
                $data[] = $row["productName"];
                $data[] = (int)$row["subtotal"];
                $alldata[] = $data;
                echo "<tr>\n";
                echo "<td>", $row["productID"], "</td>\n";
                echo "<td>", $row["productName"], "</td>\n";
                echo "<td>", $row["subtotal"], "</td>\n";
                echo "</tr>\n";
            }
            echo "</tbody></table>\n";
//                print_r($alldata);
        }
        ?>

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

</div>

</body>
</html>
