<?php
    namespace Models;


    class Cinema{

        private $name;
        private $address;
        private $capacity;
        private $priceTicket;

        public function __construct($name='', $address='', $capacity='', $priceTicket=''){
            $this->name = $name;
            $this->address = $address;
            $this->capacity = $capacity;
            $this->priceTicket = $priceTicket;

        }

        public function setName($name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }
        
        public function setAddress($address){
            $this->address = $address;
        }

        public function getAddress(){
            return $this->address;
        }

        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }
        public function getCapacity(){
            return $this->capacity;
        }

        public function setPriceTicket($priceTicket){
            $this->priceTicket = $priceTicket;
        }
        public function getPriceTicket(){
            return $this->priceTicket;
        }

        
    }

?>