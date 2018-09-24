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
			echo "<p>Product couldn't be correctly sold</p>";

		else
			echo "<p>Correctly recorded the sale of $quantity $productName /s</p>";
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
		<a href="sellProduct.html">Go Back</a>
	</body>
</html>