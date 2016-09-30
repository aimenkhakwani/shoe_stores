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

        
    }
?>
