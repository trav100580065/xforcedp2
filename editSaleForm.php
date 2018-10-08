<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="Travis Wheeler, JJ" />
    <meta charset="utf-8" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<header>
    <h1>Welcome to People Health Pharmacy</h1>
</header>

<body>
    <div class="container">
        <div class="panel-body">

            <div class="row">
                <h2 class="centered">Edit a Sales Record</h2>
                <p class="centered">Enter Sale id and Product id for sales record to edit. Enter new Quantity number.</p>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="editSale.php" method="post">

                        <div class="form-group">
                            <label for="saleDate">Sale Date:</label>
                            <input type="date" name="saleDate" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="productNameInput">Product Name:</label>
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

                                  $select = '<select name="productNameInput" class="form-control">';
                                  while($row = mysqli_fetch_assoc($product_names)){
                                    $select.='<option value="'.$row['productName'].'">'.$row['productName'].'</option>';
                                  }

                                  $select.='</select>';
                                  echo $select;
                                }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" name="quantity" class="form-control" />
                        </div>

                        <div class="col-xs-6">
                            <a class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-6 col-sm-offset-6" href="index.html">Back</a>
                        </div>

                        <div class="col-xs-6">
                            <input type="submit" class="btn btn-default col-sm-6 col-xs-12"/>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
