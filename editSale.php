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

    $saleDate = $_POST['saleDate'];
    $productName = $_POST['productNameInput'];
    $quantity = $_POST['quantity'];

	//validate user input
    if(!is_numeric($quantity)){
      echo "Quantity must be a number";
    }
    else {
	//add a sales record to sales table
      $result = update_sales_record($db, $saleDate, $productName, $quantity);

      if(!$result){
        echo "<p> Something is wrong with your query</p>";
      }
      else{
        echo "<p>Sales record updated successfully</p>";
      }
    }
}
  db_disconnect($db);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="author" content="JJ"/>
  </head>
  <body>
    <a href="index.html">Back to Main Menu</a>
  </body>
</html>