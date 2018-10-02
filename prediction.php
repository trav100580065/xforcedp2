<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once('database.php');
  require_once('query_functions.php');

  //connect to database
  $db = db_connect();

  if(!$db){
    die("Connection failed: " . mysqli_connect_error());
    echo "<p>Database connection failure</p>";
  }
  else{

    $sql = "SELECT productID FROM php_database.inventory where totalQuantity < 5";

    $result = $db->query($sql);

    //db_disconnect($db);
  }

   ?>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="..." />
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
      <h3>Generate Prediction Report</h3>
      <div class="row">
          <div class="col-md-6">
            <?php
            while($row = mysqli_fetch_array($result)){
              $num = $row['productID'];
              $sql = "SELECT productName FROM php_database.product where productID = $num";
              $prod = $db->query($sql);
              while($row2 = mysqli_fetch_array($prod)){
                echo "<p>Place orders for item: " .  $row2['productName']   . "</p>";
              }
            }
            ?>
          </div>
      </div>

    </div>
</body>
</html>
