<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{
  echo"<h1>Products</h1>";

  $products_set = find_all_products($db);

  //display the retrieved records
	echo "<table border = \"1\">\n";
	echo "<tr>\n"
				."<th scope=\"col\">Product ID</th>\n"
				."<th scope=\"col\">Product Name</th>\n"
				."<th scope=\"col\">Category</th>\n"
        ."<th scope=\"col\">Supplier</th>\n"
        ."<th scope=\"col\">Price</th>\n"
				."</tr>\n";

			while($row = mysqli_fetch_assoc($products_set)){
				echo "<tr>\n";
				echo "<td>", $row["productID"], "</td>\n";
				echo "<td>", $row["productName"], "</td>\n";
				echo "<td>", $row["category"], "</td>\n";
        echo "<td>", $row["supplier"], "</td>\n";
        echo "<td>", $row["price"], "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

  mysqli_free_result($products_set);
}
?>
