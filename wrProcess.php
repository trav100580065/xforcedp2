<?php
session_start();
require_once('database.php');
require_once('query_functions.php');
$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{

    if(isset($_POST["btnExport"])){
        $sales_set = find_weekly_sales($db, $_SESSION['endDate'], $_SESSION['productName']);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="panel-body">
          <ul class="nav nav-pills">
              <li><a href="weekly_report.php">Back</a></li>
          </ul>
        </div>
		<form method="post" action="wrProcess.php">
            <input type="submit" name="btnExport" value="CSV Export" class="btn btn-success" />
        </form>
        <br />
        <h3>Weekly Sales Report</h3>
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
              $endDate = $_POST['endDate'];
              $productName = $_POST['select'];
			  
			  // save end date and product name in session variables
              $_SESSION['endDate'] = $endDate;
              $_SESSION['productName'] = $productName;

              $sales_set = find_weekly_sales($db, $endDate, $productName);

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
            }
            ?>
    </div>
</body>
</html>
