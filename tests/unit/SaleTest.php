<?php

class addSaleTest extends \PHPUnit_Framework_TestCase
{
  public function testDatabaseConnect(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $this->assertFalse(die("Connection failed: " . mysqli_connect_error()));
  }

  public function testAddMysqlQuery(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = add_sales_record($db, 1, 1, 1);

    $this->assertFalse(!$result);
  }

  public function testUpdateMysqlQuery(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $result = update_sales_record($db, 1, 1, 1);

    $this->assertFalse(!$result);
  }

}
