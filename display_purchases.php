<?php
require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{
  echo"<h1>Purchase Records</h1>";

  //retrieve records from the purchase table
  $purchases_set = find_all_purchases($db);

  //display the retrieved records
	echo "<table border = \"1\">\n";
	echo "<tr>\n"
				."<th scope=\"col\">Purchase ID</th>\n"
				."<th scope=\"col\">Product ID</th>\n"
				."<th scope=\"col\">Purchase Date</th>\n"
        ."<th scope=\"col\">Expiry Date</th>\n"
        ."<th scope=\"col\">Quantity Remaining</th>\n"
        ."<th scope=\"col\">Available</th>\n"
				."</tr>\n";

			while($row = mysqli_fetch_assoc($purchases_set)){
				echo "<tr>\n";
				echo "<td>", $row["purchaseID"], "</td>\n";
				echo "<td>", $row["productID"], "</td>\n";
				echo "<td>", $row["purchase_date"], "</td>\n";
        echo "<td>", $row["expiry_date"], "</td>\n";
        echo "<td>", $row["quantity_remaining"], "</td>\n";
        echo "<td>", $row["available"], "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

  mysqli_free_result($purchases_set);
}

db_disconnect($db);
?>
