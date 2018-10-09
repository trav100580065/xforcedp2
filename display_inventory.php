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
        <div class="panel-body">
            <div class="row">
                <h2 class="centered">Inventory Items Table</h2>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-5 col-md-offset-1">
                    <form method="post" action="display_products.php">
                        <input type="submit" name="btnExport" value="CSV Export" class="btn btn-success col-xs-12" />
                    </form>
                </div>

                <div class="col-md-5">
                    <a class="btn btn-default col-xs-12" href="index.html">Back</a>
                </div>
            </div>

            <br/><br/><br/>

            <div class="col-xs-12">
    			<div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Total Quantity</th>
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
                                    //retrieve records from inventory table
                                      $inventory_set = find_all_inventory($db);

                                      //display the retrieved records
                                                while($row = mysqli_fetch_assoc($inventory_set)){
                                                    echo "<tr>\n";
                                                    echo "<td>", $row["productID"], "</td>\n";
                                    				echo "<td>", $row["totalQuantity"], "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</table>\n";

                                      mysqli_free_result($inventory_set);
                                    }

                                ?>
                            </tbody>
                        </table>
        			</div>
    			</div>
            </div>
        </div>
    </div>
</body>

</html>
