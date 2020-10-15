<?php
    namespace Models;


    class Cinema{

        private $name;
        private $address;
        private $capacity;
        private $priceTicket;
        private $id;
        
        public function __construct($name='', $address='', $capacity='', $priceTicket='', $id=''){
            $this->name = $name;
            $this->address = $address;
            $this->capacity = $capacity;
            $this->priceTicket = $priceTicket;
            $this->id = $id;

            if(empty($id)){
                $this->id = getdate()['0'];
            }
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


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }
    }

?>