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

   ?>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="..." />
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
        <ul class="nav nav-pills">
            <li><a href="index.html">Back</a></li>
        </ul>
      </div>
      <h3>Generate Prediction Report</h3>
      <div class="row">
          <div class="col-md-6">
            <?php

            find_prediction_results($db);
            db_disconnect($db);
            ?>
          </div>
      </div>

    </div>
</body>
</html>
