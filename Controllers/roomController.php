<?php
  namespace Controllers;

    use Models\room as Room;
    use DAODB\room as roomDB;
    use DAODB\cinema as cinemaDB;
    use Models\cinema as Cinema;
    use Models\showCinema as Show;
    use DAODB\ShowCinema as ShowDB;
    use DAODB\Genre as GenreDB;


    class RoomController{
        private $roomDB;
        private $cinemaDB;
        private $showDB;

        public function __construct()
        {
            $this->roomDB = new roomDB();
            $this->cinemaDB = new cinemaDB();
            $this->showDB = new ShowDB();
            $this->genreDB = new GenreDB();
        }

        public function ShowAddViewRoom($id_cinema, $message='', $success='')
        {
          require_once(VIEWS_PATH."room-add.php");
        }
        

        public function ShowListShowsView($idRoom){

            $showList = $this->showDB->GetByRoom($idRoom);
            $genreList = $this->genreDB->GetAll();

          require_once(VIEWS_PATH."show-list.php");


        }

        public function Add($room_name, $price, $room_capacity, $id_cinema)
        {   
            $room = new Room(); 
            $room->setRoomName($room_name);
            $room->setPrice($price);
            $room->setRoomCapacity($room_capacity);
            $room->setCinema($this->cinemaDB->GetOne($id_cinema));
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