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

  $sql = "INSERT INTO php_database.sales(orderID, productID, date, quantity) values ('$saleID', '$productID', current_timestamp, '$quantity')";

  if($conn->query($sql) === TRUE){
    echo "New Sales record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

?>
