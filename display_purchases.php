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
</head>

<header>
    <h1>Welcome to People Health Pharmacy</h1>
</header>

<body>
    <div class="container">
        <div class="filterSpace">
           <div class="row">
				<div class="col-md-4">
				<form action="display_purchases.php" method="post">
					<div class="form-group">
					<label for="date">Date filter</label>
					<input type="text" id="date" name="date" class="form-control">
					<br />
					<input type="submit" name="filter_date" class="btn btn-default" >
					</div>
				</form>
				<form action="display_purchases.php" method="post">
					<div class="form-group">
					<label for="quantity">Quantity filter</label>
					<input type="submit" name="filter_quantity" class="btn btn-default">
					</div>
				</form>
			</div>
          </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-6 col-xs-offset-3">
                <a class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-3" href="index.html">Back</a>
            </div>

            <div class="col-xs-12">
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
                            require_once ('filter_functions.php');

                            $db = db_connect();

                            if(!$db){
                              die("Connection failed: " . mysqli_connect_error());
                              echo "<p>Database connection failure</p>";
                            }
                            else{
                              echo"<h1>Purchase Records</h1>";

                              //retrieve records from the purchase table
                                if (isset( $_POST["filter_date"])) {
                                    $purchases_set = filter_date($db,'purchases',  $_POST["date"]);
                                } else if (isset( $_POST["filter_quantity"])){
                                    $purchases_set = order_quantity($db,'purchases');
                                } else {
                                    $purchases_set = find_all_purchases($db);
                                }

                              //display the retrieved records
                                        while($row = mysqli_fetch_assoc($purchases_set)){
                                            echo "<tr>\n";
                                            echo "<td>", $row["purchaseID"], "</td>\n";
                                            echo "<td>", $row["productID"], "</td>\n";
                                            echo "<td>", $row["purchaseDate"], "</td>\n";
                            				echo "<td>", $row["expiryDate"], "</td>\n";
                            				echo "<td>", $row["quantityRemaining"], "</td>\n";
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
    </div>
</body>

</html>
