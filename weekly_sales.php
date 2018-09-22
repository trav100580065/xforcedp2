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
        <h3>Weekly Sales Report</h3>
        <div class="row">
            <div class="col-md-2">
              <form method="post" action="weekly_sales.php">
                  <div class="form-group">
                      <label for="endDate">Week ending: </label>
                      <input type="date" name="endDate" class="form-control" />
                  </div>
                  <div class="form-group">
                      <input type="submit" name="btnSubmit" class="btn btn-default" value="Submit" />
                  </div>
              </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Sale Date</th>
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
                  if(!isset($_POST["btnSubmit"])){
                    //if submit button not clicked, display all Records
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
                  else{
                    if(isset($_POST["endDate"])){

                      $endDate = $_POST["endDate"];

                      $result = find_weekly_sales($db, $endDate);

                      //display the retrieved records
                        while($row = mysqli_fetch_assoc($result)){
                          echo "<tr>\n";
                          echo "<td>", $row["productID"], "</td>\n";
                          echo "<td>", $row["productName"], "</td>\n";
                          echo "<td>", $row["recordDate"], "</td>\n";
          				        echo "<td>", $row["subtotal"], "</td>\n";
                          echo "</tr>\n";
                        }
                      echo "</table>\n";

                      mysqli_free_result($result);

                    }
                  }
                }
                db_disconnect($db);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
