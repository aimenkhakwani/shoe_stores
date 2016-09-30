<?php
    class Store
    {
        private $name;
        private $address;
        private $id;

        function __construct($name, $address, $id = null)
        {
            $this->name = $name;
            $this->address = $address;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setAddress($new_address)
        {
            $this->address = (string) $address;
        }

        function getAddress()
        {
            return $this->address;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, address) VALUES ('{$this->getName()}', '{$this->getAddress()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $address = $store['address'];
                $id = $store['id'];
                $new_store = new Store($name, $address, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }
    }
?>
