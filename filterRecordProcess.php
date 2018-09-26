<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="People Health Pharmacy web app" />
    <meta name="keywords" content="Database" />
    <meta name="author" content="Harshit Tomar" />
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
        <br />
        <form method="post" action="export_products.php">
            <input type="submit" name="export_products" value="CSV Export" class="btn btn-success" />
        </form>
        <br />

        <table class="table table-striped">
            <?php
            require_once('database.php');
            require_once('query_functions.php');
            require_once('filter_ID_and_name.php');

            $db = db_connect();

            if(!$db){
                die("Connection failed: " . mysqli_connect_error());
                echo "<p>Database connection failure</p>";
            }
            else{
                echo"<h1>Products</h1>";
                $searchBy = $_GET['searchBy'];
                $table = $_GET['table'];
                $id = $_GET['ID'];
                $name = $_GET['name'];
                if($searchBy=='id'){
                    $products_set = filter_by_ID($db,$table,$id);
                }
                elseif ($searchBy=='name'){
                    $products_set = filter_name($db,$table,$name);

                }
//                $products_set = filter_name($db,$table,$name);

                echo "<tr>";
                for($i = 0; $i < mysqli_num_fields($products_set); $i++) {
                    $field_info = mysqli_fetch_field($products_set);
                    echo "<th>{$field_info->name}</th>";
                }



                // Print the data
                while($row = mysqli_fetch_assoc($products_set)) {
                    echo "<tr>";
                    foreach($row as $_column) {
                        echo "<td>{$_column}</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>\n";

                mysqli_free_result($products_set);
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>

<!---->
<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!---->
<!--<head>-->
<!--    <meta name="author" content="Travis Wheeler" />-->
<!--    <meta charset="utf-8" />-->
<!--    <title>People Health Pharmacy Records Management System</title>-->
<!--    <!-- Reference to Bootstrap CDN -->-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--</head>-->
<!--<body>-->
<?php
//require_once('filter_ID_and_name.php');
//require_once('database.php');
//$db = db_connect();
////$output = filter_ID($db,$_GET['table'],$_GET['ID']);
//
//if(!$db){
//    die("Connection failed: " . mysqli_connect_error());
//    echo "<p>Database connection failure</p>";
//}
//else{
//    echo"<h1>Products</h1>";
//
////    $products_set = find_all_products($db);
//    $products_set = filter_IDab($db,$_GET['table'],$_GET['ID']);
//
//    //display the retrieved records
//    while($row = mysqli_fetch_assoc($products_set)){
//        echo "<tr>\n";
//        echo "<td>", $row["productID"], "</td>\n";
//        echo "<td>", $row["productName"], "</td>\n";
//        echo "<td>", $row["category"], "</td>\n";
//        echo "<td>", $row["supplier"], "</td>\n";
//        echo "<td>", $row["price"], "</td>\n";
//        echo "</tr>\n";
//    }
//    echo "</table>\n";
//
//    mysqli_free_result($products_set);
//}
//
//
//
//
//
//?>
<!---->
<!--</body>-->
<!--</html>-->
