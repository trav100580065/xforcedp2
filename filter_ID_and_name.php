<?php
/**
 * Created by PhpStorm.
 * User: Harshit
 * Date: 10/09/2018
 * Time: 2:01 PM
 */

function filter_by_ID($db, $table, $ID) {
    //Returns a selection based on the ID given.

    $result = NULL;

    //Checking in which table we are searching for ID
    if($table == 'inventory' || $table =='product') {
        $sql = "SELECT * FROM $table WHERE productID = '$ID'";
        $result = mysqli_query($db, $sql);
    }
    elseif ($table == 'purchase'){
        $sql = "SELECT * FROM $table WHERE purchaseID = '$ID'";
        $result = mysqli_query($db, $sql);
    }
    elseif ($table == 'sales'){
        $sql = "SELECT * FROM $table WHERE orderID = '$ID'";
        $result = mysqli_query($db, $sql);
    }
    else {
        echo "Invalid table selection";
    }

    if(!$result) {
        echo "<p>Something is wrong with query ", $result, "</p>";
    }
    else{return $result;}
}

function filter_name($db, $table, $name) {
    //Returns a selection based on the name given.

    $result = NULL;

    if ($table == 'product'){
        $sql = "SELECT * FROM $table WHERE product_name = '$name'";
        $result = mysqli_query($db, $sql);
    }
    else{ echo "Search by name is available for only product table";}

    if(!$result) {
        echo "<p>Something is wrong with query ", $result, "</p>";
    }
    else{return $result;}

}
