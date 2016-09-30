<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);

            //Act
            $result = $brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Nike";

            $id = 14;
            $brand = new Brand($name, $id);

            //Act
            $result = $brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            $name2 = "Adidas";
            $brand2 = new Brand($name2);
            $brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand, $brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            $name2 = "Adidas";
            $brand2 = new Brand($name2);
            $brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            $name2 = "Adidas";
            $brand2 = new Brand($name2);
            $brand2->save();

            //Act
            $find_id = $brand2->getId();
            $result = Brand::find($find_id);

            //Assert
            $this->assertEquals($brand2, $result);
        }

        function test_addStore()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);
            $store->save();

            //Act
            $brand->addStore($store);
            $result = $brand->getStores();

            //Assert
            $this->assertEquals([$store], $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = "Nike";
            $brand = new Brand($name);
            $brand->save();

            $name = "Shoes Galore";
            $address = "9718 NE 8th Street";
            $store = new Store($name, $address);
            $store->save();

            $name2 = "All Shoes";
            $address2 = "9718 NE 11th Ave";
            $store2 = new Store($name2, $address2);
            $store2->save();

            //Act
            $brand->addStore($store);
            $brand->addStore($store2);
            $result = $brand->getStores();

            //Assert
            $this->assertEquals([$store, $store2], $result);
        }
    }
?>
