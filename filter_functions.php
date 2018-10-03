<?php
/**
 * Created by PhpStorm.
 * User: Cyrus
 * Date: 29/08/2018
 * Time: 11:22 AM
 */



function filter_category($db, $table, $category) {
    //Returns a selection based on the category given.

    $result = NULL;

    //The product table is the only table with the 'category' column, so here is a safety check.
    if($table != 'product') echo "Invalid table selection";

    else {
        $sql = "SELECT * FROM $table WHERE category = '$category'";
        $result = mysqli_query($db, $sql);
    }
        return $result;
}

function filter_date($db, $table, $date) {
    //Returns a selection based on the date given.

    $result = NULL;

    //The product table is the only table with the 'category' column, so here is a safety check.
    if($table != 'purchases' && $table != 'sales') echo "Invalid table selection";

    else {
        if ($table == 'purchases') {
            $sql = "SELECT * FROM $table WHERE purchaseDate = '$date'";
        } else {
            $sql = "SELECT * FROM $table WHERE recordDate = '$date'";
        }
        $result = mysqli_query($db, $sql);
    }
    return $result;
}


function order_quantity($db, $table) {
    //Returns a selection ordered by the quantity of the items.

    $result = NULL;

    //The product table is the only table with the 'category' column, so here is a safety check.
    if($table != 'inventory' && $table != 'purchases' && $table != 'sales') echo "Invalid table selection";

    else {
        if ($table == 'inventory') {
            $sql = "SELECT * FROM $table ORDER BY totalQuantity";
        } else if ($table == 'purchases') {
            $sql = "SELECT * FROM $table ORDER BY quantityRemaining";
        } else {
            $sql = "SELECT * FROM $table ORDER BY quantity";
        }
        $result = mysqli_query($db, $sql);
    }
    return $result;
}

function order_expiration_date($db, $table) {
    //Returns a selection ordered by the expiration date of the items.

    $result = NULL;

    //The product table is the only table with the 'category' column, so here is a safety check.
    if($table != 'purchases') echo "Invalid table selection";

    else {
        $sql = "SELECT * FROM $table ORDER BY expiryDate";
        $result = mysqli_query($db, $sql);
    }
    return $result;
}
