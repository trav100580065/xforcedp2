<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="..." />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      function validate(){
        var endDate = document.getElementsByName('endDate')[0].value;
        if(endDate != null){
          return true;
        }
        return false;
      }
    </script>
</head>

<header>
    <h1>Welcome to People Health Pharmacy</h1>
</header>

<body>
    <div class="container">

        <div class="row">
            <h2 class="centered">Generate Monthly Sales Report</h2>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="post" action="mthProcess.php" onsubmit="return validate();">
                    <div class="form-group">
                        <label for="endDate">Select Month: </label>
                        <input type="month" name="endDate" class="form-control" placeholder="yyyy-mm"/>
                    </div>

                    <div class="form-group">
                        <label>Select Product: </label>
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
                          define("ALL_PRODUCTS", "All");

                          $select = '<select name="select">';
                          $select.='<option value="'.ALL_PRODUCTS.'">'.ALL_PRODUCTS.'</option>';
                          while($row = mysqli_fetch_assoc($product_names)){
                            $select.='<option value="'.$row['productName'].'">'.$row['productName'].'</option>';
                          }

                          $select.='</select>';
                          echo $select;
                        }
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <a class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-5" href="index.html">Back</a>
                    </div>

                    <div class="col-xs-6">
                        <input type="submit" class="btn btn-default col-sm-6 col-xs-12 col-sm-offset-1"/>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>
</html>
