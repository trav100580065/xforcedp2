<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{
  $products_set = find_all_products($db);
  $row_count = mysqli_num_rows($products_set);

  if($row_count > 0){
    $delimiter = ",";
    $filename = "products.csv";

    //set headers to download file rather than display
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=products.csv;');

    //create a file pointer
    $f = fopen($filename, "w") or die("Unable to open file.");

    //set column headers
    $fields = array('ProductID', 'ProductName', 'Category','Supplier','Price');
    fputcsv($f, $fields, $delimiter);

    //output each row of data and format as csv
    while($row = mysqli_fetch_assoc($products_set)){
      $lineData = array($row["productID"], $row["productName"], $row["category"], $row["supplier"], $row["price"]);
      fputcsv($f, $lineData, $delimiter);
    }
    //move back to beginning of file
    fseek($f, 0);
    fclose($f);
  }
}
exit;
?>
