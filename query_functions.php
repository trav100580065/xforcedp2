<?php
//this file stores all common queries

function find_all_sales($db){
  $sql_table = "sales";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

function add_sales_record($db, $saleID, $productID, $quantity){
  $sql_table = "sales";
  $sql = "INSERT INTO $sql_table (orderID, productID, recordDate, quantity)
  values ('$saleID', '$productID', current_timestamp, '$quantity')";
  $result = @mysqli_query($db, $sql);
  return $result;
}

function update_sales_record($db, $saleID, $productID, $quantity){
  $sql_table = "sales";
  $sql = "UPDATE $sql_table SET  quantity = $quantity WHERE productID == $productID && orderID = $saleID";
  $result = @mysqli_query($db, $sql);
  return $result;
}

function find_all_products($db){
  $sql_table = "product";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

function find_all_inventory($db){
  $sql_table = "inventory";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

function find_all_purchases($db){
  $sql_table = "purchases";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

//Function to add a new product to the database
function add_New_Product($db, $productName, $category, $supplier, $price){

  //Checks for a product with inputted name already present
  $result = get_Product_ID($db, $productName);

  //Checks if there is already a product with that name
  if ($result == "") {
    $sql = "INSERT INTO product (product_name, category, supplier, price)
    VALUES ('$productName', '$category', '$supplier', '$price')";
    $result = @mysqli_query($db, $sql);
  }

  //There is already a product with this name
  else {
    $result = null;
  }

  return $result;
}


//Function that searches for product ID which has the same product name that's being inputted
function get_Product_ID($db, $productName)
{
  //Saves $sql as a select statement which will receive the productID
  $sql = "SELECT * FROM product
  WHERE product_name = '$productName' limit 1";

  //Runs the sql statement, and then saves the row as an array
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result);

  return $row[0];
}


//Saves the purchase to the database
function add_New_Purchase($db, $productName, $purchaseDate, $expiryDate, $quantity)
{
  //Gets the Product ID for the inputted name
  $productID = get_Product_ID($db, $productName);

  //Checks if the product does exist
  if ($productID != null)
  {
    //SQL Statement to insert a new row into the purchases table
    $sql = "INSERT INTO purchases (productID, purchase_date, expiry_date, quantity_remaining, available)
    VALUES ('$productID', '$purchaseDate', '$expiryDate', '$quantity', true)";
    $result = @mysqli_query($db, $sql);
    return $result;
  }
  else
    return null;
}


//Add Item to Inventory
//TODO Need to change this function so that it checks whether the item already exists in the Inventory.  Will rename to "update_Inventory"
//This function runs off the assumption that a product already exists in the productID table
function add_New_Item_To_Inventory($db, $productName, $quantity)
{
  //Locates the product ID
  $productID = get_Product_ID($db, $productName);
  echo "<p>Product ID is: $productID</p>";

  $sql = "INSERT INTO `inventory`(`productID`, `total_quantity`) VALUES ('$productID', '$quantity')";

  $result = @mysqli_query($db, $sql);

  echo "<p>Result is $result</p>";

  //NEED TO UPDATE TO CHECK FOR ITEM ALREADY IN INVENTORY AND THEN ADD MORE STOCK TO ITEM

  return $result;
}
?>
