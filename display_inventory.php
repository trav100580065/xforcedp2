<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{
echo"<h1>Inventory Items</h1>";
//retrieve sales records from sales table
  $inventory_set = find_all_inventory($db);

  //display the retrieved records
	echo "<table border = \"1\">\n";
	echo "<tr>\n"
				."<th scope=\"col\">Product ID</th>\n"
        ."<th scope=\"col\">Total Quantity</th>\n"
				."</tr>\n";

			while($row = mysqli_fetch_assoc($inventory_set)){
				echo "<tr>\n";
				echo "<td>", $row["productID"], "</td>\n";
        echo "<td>", $row["total_quantity"], "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

  mysqli_free_result($inventory_set);
}

?>
