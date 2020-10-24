<?php
    namespace Models;

    class Room {
        private $id_room;
        private $room_name;
        private $price;
        private $capacity;
        private $id_show_cinema;
        private $id_cinema;

        public function __construct($id_room='', $room_name='', $price='', $capacity='',$id_show_cinema = '', $id_cinema='')
        {
            $this->id_room = $id_room;
            $this->room_name = $room_name;
            $this->price = $price; 
            $this->capacity = $capacity; 
            $this->id_show_cinema = $id_show_cinema;
            $this->id_cinema = $id_cinema;
        }

        public function getIdRoom()
        {
            return $this->id_room;
        }
    
        public function setIdRoom($id_room)
        {
            $this->id_room = $id_room;
        }

        public function getRoomName()
        {
            return $this->room_name;
        }
    
        public function setName($room_name)
        {
            $this->room_name = $room_name;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }
 
        public function getCapacity()
        {
            return $this->capacity;
        }

        public function setCapacity($capacity)
        {
            $this->capacity = $capacity;
        }

        public function getIdShowCinema()
        {
            return $this->id_show_cinema;
        }

        public function setIdShowCinema($id_show_cinema)
        {
            $this->id_show_cinema = $id_show_cinema;
        }

        public function getIdShowCinema()
        {
            return $this->id_cinema;
        }

        public function setIdShowCinema($id_cinema)
        {
            $this->id_cinema = $id_cinema;
        }
        
}

