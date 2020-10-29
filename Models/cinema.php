<?php
    namespace Models;


    class Cinema{
    
        private $id_cinema;
        private $cinema_name;
        private $address;
        private $capacity;
        private $rooms;
      
        public function __construct( $id_cinema='', $cinema_name='', $address='', $capacity='',$rooms=''){
            $this->id_cinema = $id_cinema;
            $this->cinema_name = $cinema_name;
            $this->address = $address;
            $this->capacity = $capacity;
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

        public function setAddress($address)
        {
            $this->address = $address;
        }

        public function getAddress()
        {
            return $this->address;
        }

        public function setCapacity($capacity)
        {
            $this->capacity = $capacity;
        }

        public function getCapacity()
        {
            return $this->capacity;
        }

        public function getIdCinema()
        {
            return $this->id_cinema;
        }

        public function setIdCinema($id_cinema)
        {
            $this->id_cinema = $id_cinema;
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