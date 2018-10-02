<?php

class predictionTest extends \PHPUnit_Framework_TestCase
{
  public function testDatabaseConnect(){
    require_once('database.php');
    require_once('query_functions.php');

    //connect to database
    $db = db_connect();

    $this->assertFalse(!$db);
  }

}
