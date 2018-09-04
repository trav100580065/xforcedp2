<?php

require_once('database.php');
require_once('query_functions.php');

$db = db_connect();

if(!$db){
  die("Connection failed: " . mysqli_connect_error());
  echo "<p>Database connection failure</p>";
}
else{
  echo"<h1>Sales Records</h1>";

  //retrieve sales records from sales table
  $sales_set = find_all_sales($db);

  //display the retrieved records
	echo "<table border = \"1\">\n";
	echo "<tr>\n"
				."<th scope=\"col\">Order ID</th>\n"
				."<th scope=\"col\">Product ID</th>\n"
				."<th scope=\"col\">Date</th>\n"
        ."<th scope=\"col\">Quantity</th>\n"
				."</tr>\n";

			while($row = mysqli_fetch_assoc($sales_set)){
				echo "<tr>\n";
				echo "<td>", $row["orderID"], "</td>\n";
				echo "<td>", $row["productID"], "</td>\n";
				echo "<td>", $row["recordDate"], "</td>\n";
        echo "<td>", $row["quantity"], "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

  mysqli_free_result($sales_set);
}

db_disconnect($db);
?>
