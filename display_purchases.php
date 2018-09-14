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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Purchase ID</th>
                        <th>Product ID</th>
                        <th>Purchase Date</th>
                        <th>Expiry Date</th>
                        <th>Quantity Remaining</th>
                        <th>Available</th>
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
  echo"<h1>Purchase Records</h1>";

  //retrieve records from the purchase table
  $purchases_set = find_all_purchases($db);

  //display the retrieved records
            while($row = mysqli_fetch_assoc($purchases_set)){
                echo "<tr>\n";
                echo "<td>", $row["purchaseID"], "</td>\n";
                echo "<td>", $row["productID"], "</td>\n";
                echo "<td>", $row["purchase_date"], "</td>\n";
        echo "<td>", $row["expiry_date"], "</td>\n";
        echo "<td>", $row["quantity_remaining"], "</td>\n";
        echo "<td>", $row["available"], "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";

  mysqli_free_result($purchases_set);
}

db_disconnect($db);
?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>