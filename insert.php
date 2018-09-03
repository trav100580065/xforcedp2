<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{

    $saleID = $_POST['saleID'];
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    if(!is_numeric($saleID)){
      echo "Sale ID must be a number";
    } else if(!is_numeric($productID)){
      echo "Product ID must be a number";
    } else if(!is_numeric($quantity)){
      echo "Quantity must be a number";
    }
    else {
      $result = add_sales_record($db, $saleID, $productID, $quantity);

      if(!$result){
        echo "<p> Something is wrong with your query</p>";
      }
      else{
        echo "<p>New Sales record created successfully</p>";
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
    <a href="addsale.html">Go Back</a>
  </body>
</html>
