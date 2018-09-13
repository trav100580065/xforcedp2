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
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Price</th>
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
  echo"<h1>Products</h1>";

  $products_set = find_all_products($db);

  //display the retrieved records
			while($row = mysqli_fetch_assoc($products_set)){
				echo "<tr>\n";
				echo "<td>", $row["productID"], "</td>\n";
				echo "<td>", $row["productName"], "</td>\n";
				echo "<td>", $row["category"], "</td>\n";
        echo "<td>", $row["supplier"], "</td>\n";
        echo "<td>", $row["price"], "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

  mysqli_free_result($products_set);
}
?>
</tbody>
</table>
</div>
</div>
</body>

</html>
