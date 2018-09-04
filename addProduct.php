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
	$category = $_POST['categoryInput'];
	$supplier = $_POST['supplierInput'];
	$price = $_POST['priceInput'];
	$quantity = $_POST['quantityInput'];
	$purchaseDate = $_POST['dateInput'];
	$expiryDate = $_POST['expiryInput'];

	//Validate the user's inputs
	if ($productName == "")
		echo "<p>Enter a product Name</p>";
	else if ($category == "")
		echo "<p>Enter a category</p>";
	else if ($supplier == "")
		echo "<p>Enter a supplier</p>";
	else if ($price == "")
		echo "<p>Enter a price</p>";
	else if (!is_numeric($price))
		echo "<p>Your price must be a number</p>";
	else if ($quantity == "")
		echo "<p>Enter a quantity</p>";
	else if (!is_numeric($quantity))
		echo "<p>Your quantity must be a number</p>";

	//If all Validations pass
	else {

		//Adds the new product to the "product" table and checks if this was successful
		$result = add_New_Product($db, $productName, $category, $supplier, $price);


		//If result is null than there is already a product with that nameroduct
		if ($result == null)
			echo "<p>There is already a product with this name</p>";

		//If product couldn't be added correctly result will be false
		else if ($result != true)
			echo "<p>Product could not be added to the table</p>";

		//otherwise, add this product to purchases as well and add this to inventory as its the first addition
		else
		{
			//Add this product to purchases
			$result = add_New_Purchase($db, $productName, $purchaseDate, $expiryDate, $quantity);

			//If the input could not be added to purchases
			if (!$result)
			{
				echo "<p>Product could not be added to inventory, but purchases could not be updated.</p";
			}

			//Checks if the productID could be found
			else if ($result == null)
				echo "<p>Product ID couldn't be correctly located.</p>";
			
			//otherwise, add the new item to inventory and increase available stock
			else
			{

				//If Product could be added, Inventory is updated
				$result = add_New_Item_To_Inventory($db, $productName, $quantity);

				//checks if Inventory could be updated also
				if (!$result){
					echo "<p>Product was successfully added, but Inventory could not be updated</p>";
				}

				//Returns confirmation of the product was added and inventory updated
				else {
					echo "<p>Successfully added a new product and updated Inventory</p>";
				}
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