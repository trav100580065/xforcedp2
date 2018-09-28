<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="JJ" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
<body>
    <div class="container">
      <div class="panel-body">
        <ul class="nav nav-pills">
            <li><a href="index.html">Back</a></li>
        </ul>
      </div>
      <h3>Generate Weekly Sales Report</h3>
      <div class="row">
          <div class="col-md-2">
            <form method="post" action="" onsubmit="return validate();">
              <div class="form-group">
                  <label for="endDate">Week ending: </label>
                  <input type="date" name="endDate" class="form-control" />
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

                  $select = '<select name="select">';
                  while($row = mysqli_fetch_assoc($product_names)){
                    $select.='<option value="'.$row['productName'].'">'.$row['productName'].'</option>';
                  }

                  $select.='</select>';
                  echo $select;
                }
                ?>
              </div>
              <div class="form-group">
                <input type="submit" name="btnSubmit" class="btn btn-default" value="Submit" />
              </div>
            </form>
          </div>
      </div>

    </div>
</body>
</html>
