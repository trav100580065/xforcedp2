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

