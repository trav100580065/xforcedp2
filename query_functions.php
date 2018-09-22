<?php
//this file stores all common queries

function find_all_sales($db){
  $sql_table = "sales";
  $sql = "SELECT * FROM $sql_table";
  $result = mysqli_query($db, $sql);
  return $result;
}

function find_sales_with_subtotals($db){
  $sql = "SELECT productID, productName, recordDate, ROUND(quantity*price, 2) AS subtotal
  from sales NATURAL INNER JOIN product
  order by recordDate DESC";
  $result = mysqli_query($db, $sql);
  return $result;
}

function find_weekly_sales($db, $endDate){
  $sql = "SELECT productID, productName, recordDate, ROUND(quantity*price, 2) AS subtotal
  FROM sales NATURAL INNER JOIN product
  WHERE datediff('$endDate', recordDate) <= 6 AND
  datediff('$endDate', recordDate) >= 0
  ORDER BY recordDate DESC";
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
    $sql = "INSERT INTO product (productName, category, supplier, price)
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
  WHERE productName = '$productName' limit 1";

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

  echo "<p>THERE IS AN ISSUE HERE</p>";

  echo "<p>ProductID IS $productID</p>";

  //Checks if the product does exist
  if ($productID != null)
  {
    //SQL Statement to insert a new row into the purchases table
    $sql = "INSERT INTO purchases (productID, purchaseDate, expiryDate, quantityRemaining, available)
    VALUES ('$productID', '$purchaseDate', '$expiryDate', '$quantity', true)";
    $result = @mysqli_query($db, $sql);
    return $result;
  }
  else
    return null;
}


//Function that searches for product ID which has the same product name that's being inputted.  Is used to check whether this item is already present in Inventory
function get_Inventory_ID($db, $productID)
{
  //Saves $sql as a select statement which will receive the productID
  $sql = "SELECT * FROM inventory
  WHERE productID = '$productID' limit 1";

  //Runs the sql statement, and then saves the row as an array
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result);

  return $row[0];
}


//Function that uses the product ID to search the quantity of that product
function get_Inventory_Quantity($db, $productID)
{
  //Saves $sql as a select statment which will 
  $sql = "SELECT totalQuantity FROM inventory
  WHERE productID = '$productID' limit 1";

  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result);

  return $row[0];
}



//Adds a new item to inventory assuming no two items can have the same name
function add_New_Item_To_Inventory($db, $productName, $quantity)
{

  //Locate the product ID
  $productID = get_Product_ID($db, $productName);

  //Locate the inventory ID
  $inventoryID = get_Inventory_ID($db, $productID);


  //Checks if there is an inventory item present with this ID
  if ($inventoryID == "")
  {
    $sql = "INSERT INTO `inventory`(`productID`, `totalQuantity`) VALUES ('$productID', '$quantity')";
  
    $result = @mysqli_query($db, $sql);

    return $result;
  }


  //If there is already an inventory item present with this ID
  else if ($inventoryID != "")
  {

    $currentValue = get_Inventory_Quantity($db, $productID);

    //Calculates the updated Value
    $updatedValue = $currentValue + $quantity;

    $sql = "UPDATE Inventory
    SET totalQuantity = '$updatedValue'
    WHERE productID='$productID'";

    $result = @mysqli_query($db, $sql);
  }

  return $result;

}

//Sells a product
function sell_Product($db, $productName, $quantity, $sellDate)
{

  $productID = get_Product_ID($db, $productName);

  if ($productID == "")
  {
    echo "<p>There is no product with this ID</p>";
    return null;
  }

  else if ($productID != null)
  {

    $inventoryID = get_Inventory_ID($db, $productID);

    //Checks if the product is present in the Inventory Table
    if ($inventoryID == "")
    {
      echo "<p>There is no inventory item for this product</p>";
      return null;
    }

    //If the product is present, then search for the item
    else
    {

      $sql = "INSERT INTO `sales`(`productID`, `recordDate`, 'quantity') VALUES ('$productID', '$sellDate', '$quantity')";

      $result = @mysqli_query($db, $sql);

      if ($result == null)
      {
        echo "<p>Unable to save the sale record</p>";
      }
      else
      {
        echo "<p>";
      }
    }
  }

  return $result;
}

?>
