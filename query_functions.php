<?php
function find_all_sales($db){
  $sql_table = "sales_records";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

function add_sales_record($db, $saleID, $productID, $quantity){
  $sql_table = "sales_records";
  $sql = "INSERT INTO $sql_table (orderID, productID, recordDate, quantity)
  values ('$saleID', '$productID', current_timestamp, '$quantity')";
  $result = @mysqli_query($db, $sql);
  return $result;
}
?>
