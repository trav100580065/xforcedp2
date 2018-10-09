<?php
require_once('database.php');
require_once('query_functions.php');
$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{

    if(isset($_POST["btnExport"])){
        $sales_set = find_sales_with_subtotals($db);
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
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="JJ" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#userInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#salesTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>
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

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="col-md-4 col-md-offset-4">
                        <form method="post" action="display_sales_record.php">

                            <input id="userInput" type="text" placeholder="Filter by product name..." class="col-xs-12"/>

                            <br/><br/>

                            <input type="submit" name="btnExport" value="CSV Export" class="btn btn-success col-md-8 col-md-offset-2"/>

                        </form>
                    </div>


                    <div class="col-xs-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Sale Date</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody id="salesTable">
                                <?php

                                    require_once('database.php');
                                    require_once('query_functions.php');

                                    $db = db_connect();

                                    if(!$db){
                                      die("Connection failed: " . mysqli_connect_error());
                                      echo "<p>Database connection failure</p>";
                                    }
                                    else{
                                      echo"<h1>Sales Records</h1>";

                                      //retrieve sales records from sales table
                                      $sales_set = find_sales_with_subtotals($db);

                                      //display the retrieved records
                                                while($row = mysqli_fetch_assoc($sales_set)){
                                                    echo "<tr>\n";
                                                    echo "<td>", $row["productID"], "</td>\n";
                                                    echo "<td>", $row["productName"], "</td>\n";
                                                    echo "<td>", $row["recordDate"], "</td>\n";
                                                    echo "<td>", $row["subtotal"], "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</table>\n";

                                      mysqli_free_result($sales_set);
                                    }

                                    db_disconnect($db);
                                ?>
                            </tbody>
                        </table>

                        <div class="col-xs-6 col-xs-offset-3">
                            <a class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-3" href="index.html">Back</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>