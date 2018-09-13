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
			<br />
            <form method="post" action="export_sales.php">
              <input type="submit" name="export_sales" value="CSV Export" class="btn btn-success"/>
            </form>
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
  echo"<h1>Sales Records</h1>";

  //retrieve sales records from sales table
  $sales_set = find_all_sales($db);

  //display the retrieved records
            while($row = mysqli_fetch_assoc($sales_set)){
                echo "<tr>\n";
                echo "<td>", $row["orderID"], "</td>\n";
                echo "<td>", $row["productID"], "</td>\n";
                echo "<td>", $row["recordDate"], "</td>\n";
        echo "<td>", $row["quantity"], "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";

  mysqli_free_result($sales_set);
}

db_disconnect($db);
?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
