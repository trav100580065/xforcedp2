<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "php_database";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }

  $saleID = $_POST['saleID'];
  $productID = $_POST['productID'];
  $quantity = $_POST['quantity'];

  if(!is_numeric($saleID)){
    echo "Sale ID must be a number";
  } else if(!is_numeric($productID)){
    echo "Product ID must be a number";
  } else if(!is_numeric($quantity)){
    echo "Quantity must be a number";
  } else {
    $sql = "INSERT INTO php_database.sales(orderID, productID, date, quantity) values ('$saleID', '$productID', current_timestamp, '$quantity')";

    if($conn->query($sql) === TRUE){
      echo "New Sales record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
?>
