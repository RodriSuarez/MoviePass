<?php
    namespace Models;


    class Cinema{
    
        private $id_cinema;
        private $cinema_name;
        private $address;
        private $capacity;
        private $id_room;
        private $id_show_cinema;

        public function __construct( $id_cinema='', $cinema_name='', $address='', $capacity='', $id_room='', $id_show_cinema = ''){
            $this->id_cinema = $id_cinema;
            $this->cinema_name = $cinema_name;
            $this->address = $address;
            $this->capacity = $capacity;
            $this->id_room= $id_room;        
            $this->id_show_cinema = $id_show_cinema;
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
            return $this->id;
        }

        public function setIdCinema($id)
        {
            $this->id = $id;
        }
    
        public function getIdRoom()
        {
            return $this->id_room;
        }

        public function setIdRoom($id_room)
        {
            $this->id_room = $id_room;
        }

        public function setIdShowCinema($id_show_cinema)
        {
            $this->id_show_cinema = $id_show_cinema;
        }
        
        public function getIdShowCinema()
        {
            return $this->id_room;
        }
    }
?>