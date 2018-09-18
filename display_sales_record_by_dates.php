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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li><a href="index.html">Back</a></li>
            </ul>
        </div>
        <h2>Select Date Range</h2>
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="display_sales_record_by_dates.php">
                    <div class="form-group">
                        <label for="startDate">Start date: </label>
                        <input type="date" name="startDate" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="endDate">End date: </label>
                        <input type="date" name="endDate" class="form-control" />
                    </div>
                    <br/>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" />
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Date</th>
                    <th>Quantity</th>
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
$errMsg = "";

if(!isset($_POST["startDate"])){
  $errMsg .= "Must enter start date";
}
if(!isset($_POST["endDate"])){
  $errMsg .= "Must enter end date";
}

if($errMsg == "")
{
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];

  $sql_table = "sales";
  $sql = "SELECT * from $sql_table
  WHERE recordDate >= '$startDate' and recordDate <= '$endDate'
  ORDER BY recordDate DESC";

  $result = mysqli_query($db, $sql);

  //display the retrieved records
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>\n";
        echo "<td>", $row["orderID"], "</td>\n";
        echo "<td>", $row["productID"], "</td>\n";
        echo "<td>", $row["recordDate"], "</td>\n";
        echo "<td>", $row["quantity"], "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";

mysqli_free_result($result);
}
}

db_disconnect($db);
?>
            </tbody>
        </table>
    </div>
</body>

</html>
