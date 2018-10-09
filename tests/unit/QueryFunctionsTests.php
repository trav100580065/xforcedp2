<?php

class queryFunctionsTest extends \PHPUnit_Framework_TestCase
{
  public function testFindAllSales(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_all_sales($db);

    $this->assertFalse(!$result);
  }

  public function testFindSalesWithSubtotals(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_sales_with_subtotals($db);

    $this->assertFalse(!$result);
  }

  public function testFindWeeklySales(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_weekly_sales($db, '2018-10-10', 'Betadine');

    $this->assertFalse(!$result);
  }

  public function testFindAllProducts(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_all_products($db);

    $this->assertFalse(!$result);
  }

  public function testFindProductNames(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_product_names($db);

    $this->assertFalse(!$result);
  }

  public function testFindInventory(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_all_inventory($db);

    $this->assertFalse(!$result);
  }

  public function testFindAllPurchases(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = find_all_purchases($db);

    $this->assertFalse(!$result);
  }
}
?>
