<?php
require_once('database.php');
require_once('query_functions.php');

//connect to database
$db = db_connect();

if (!$db){
	die("Connection failed: " . mysqli_connect_error());
	echo "<p>Database connection failure</p>";
}
else {

	//Receive User's inputs
	$productName = $_POST['productNameInput'];
	$quantity = $_POST['quantityInput'];
	$sellDate = $_POST['dateInput'];

	//Validate the user's inputs
	if ($productName == "")
		echo "<p>Enter a product Name</p>";
	else if (!is_numeric($quantity))
		echo "<p>Your quantity must be a number</p>";

	//If all Validations pass
	else {

		//Adds the new product to the "product" table and checks if this was successful
		$result = sell_Product($db, $productName, $quantity, $sellDate);

		//Checks if the productID could be found
		if ($result == null)
			echo "<p>Theres no item in the inventory with this name</p>";


		$result = add_New_Product($db, $productName, $category, $supplier, $price);

		/*
		//If product couldn't be added correctly result will be false
		if ($result != true)
			echo "<p>There is already a product with this name</p>";
		*/

		//otherwise, add this product to purchases as well and add this to inventory as its the first addition
		
		//Add this product to purchases
		$result = add_New_Purchase($db, $productName, $purchaseDate, $expiryDate, $quantity);

		//If the input could not be added to purchases
		if (!$result)
		{
			echo "<p>Product could be added to inventory, but purchases could not be updated.</p";
		}


		//otherwise, add the new item to inventory and increase available stock
		else
		{

			//If Product could be added, Inventory is updated
			$result = add_New_Item_To_Inventory($db, $productName, $quantity);

			//checks if Inventory could be updated also
			if (!$result){
				echo "<p>Product and Purhcases were successfully updated, but inventory could not be updated</p>";
			}

			//Returns confirmation of the product was added and inventory updated
			else {
				echo "<p>Successfully added a new product and Inventory and Purhcases were updated correctly</p>";
			}
		}

	}
}

db_disconnect($db);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="author" content="Jackson O'Shea"/>
	</head>
	<body>
		<a href="addProduct.html">Go Back</a>
	</body>
</html>