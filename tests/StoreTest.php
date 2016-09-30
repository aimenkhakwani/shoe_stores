<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);

            //Act
            $result = $store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }
?>
