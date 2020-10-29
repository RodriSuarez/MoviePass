<?php
  namespace Controllers;

    use Models\room as Room;
    use DAODB\room as roomDB;
    use DAODB\cinema as cinemaDB;
    use Models\cinema as Cinema;
    class RoomController{
        private $roomDB;
        private $cinemaDB;

        public function __construct()
        {
            $this->roomDB = new roomDB();
            $this->cinemaDB = new cinemaDB();
            $cinema = new Cinema();
        }

        public function ShowAddViewRoom($id_cinema, $message='', $success='')
        {
          
            $cinema=$this->cinemaDB->GetOne($id_cinema);
            $roomList=$this->roomDB->GetAll();
            require_once(VIEWS_PATH."room-add.php");
        }
        public function Add($room_name, $price, $room_capacity, $id_cinema)
        {   
            $room = new Room(); 
            $room->setRoomName($room_name);
            $room->setPrice($price);
            $room->setRoomCapacity($room_capacity);
            if(!$this->roomDB->exist($room_name, $id_cinema)) {
                 $this->roomDB->Add($room, $id_cinema);
                 $success=true;
             }
            else
                $success = false;
           
            if($success){
                $message = '¡Se ha agregado a ' . $room_name . ' con exito!';
                
            }else{
                $message = '¡Error inesperado! No se ha podido agregar a ' . $room_name;
            }
            

            $this->ShowAddViewRoom($id_cinema, $message, $success);
        }
}