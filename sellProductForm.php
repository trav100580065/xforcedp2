<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sell Product</title>
	<meta charset="utf-8"/>
	<meta name="author" content="Jackson O'Shea"/>
	<title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li><a href="index.html">Back</a></li>
            </ul>
            <div class="row">
                <div class="col-md-4">

                    <h2>Sell Product</h2>
                    <form method="post" action="sellProduct.php">
                      <div class="form-group">
                        <label for="productNameInput">Product Name: </label>
												<?php
				                require_once('database.php');
				                require_once('query_functions.php');

				                $db = db_connect();

				                if(!$db){
				                  die("Connection failed: " . mysqli_connect_error());
				                  echo "<p>Database connection failure</p>";
				                }
				                else{
				                  $product_names = find_product_names($db);

				                  $select = '<select name="productNameInput">';
				                  while($row = mysqli_fetch_assoc($product_names)){
				                    $select.='<option value="'.$row['productName'].'">'.$row['productName'].'</option>';
				                  }

				                  $select.='</select>';
				                  echo $select;
				                }
				                ?>
                      </div>
                      <div class="form-group">
                        <label for="quantityInput">Quantity: </label>
                        <input type="text" name="quantityInput" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label for="dateInput">Date: </label>
                        <input type="date" name="dateInput" class="form-control" />
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-default" />
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
