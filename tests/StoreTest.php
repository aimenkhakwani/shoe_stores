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
        protected function tearDown()
        {
            Store::deleteAll();
        }

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

        function test_getAddress()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);

            //Act
            $result = $store->getAddress();

            //Assert
            $this->assertEquals($address, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $id = 14;
            $store = new Store($name, $address, $id);

            //Act
            $result = $store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);
            $store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);
            $store->save();

            $name2 = "Shoes Galore";
            $address2 = "9718 NE 8th Street";
            $store2 = new Store($name2, $address2);
            $store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$store, $store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);
            $store->save();

            $name2 = "Shoes Galore";
            $address2 = "9718 NE 8th Street";
            $store2 = new Store($name2, $address2);
            $store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }
?>
