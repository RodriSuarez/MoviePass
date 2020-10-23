<?php
    namespace Models;


    class Cinema{

        private $cinema_name;
        private $address;
        private $capacity;
        private $id;
        private $rooms;
        
        public function __construct($cinema_name='', $address='', $capacity='', $rooms='', $id=''){
            $this->cinema_name = $cinema_name;
            $this->address = $address;
            $this->capacity = $capacity;
            $this->id = $id;
            $this->rooms= $rooms;
         
        }

        public function getCinemaName()
    {
        return $this->cinema_name;
    }

    public function setCinemaName($cinema_name)
    {
        $this->cinema_name = $cinema_name;

        
    }

    voy a preparar el mate!!
        
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
 
    public function getRooms()
    {
        return $this->rooms;
    }

 
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        
    }

  
}

?>