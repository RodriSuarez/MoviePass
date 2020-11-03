<?php
  namespace Controllers;

    use DAODB\room as roomDB;
    use DAODB\cinema as cinemaDB;
    use DAODB\ShowCinema as ShowDB;
    use DAODB\Genre as GenreDB;

    use Models\room as Room;
    use Models\cinema as Cinema;
    use Models\showCinema as Show;

    use Controllers\CinemaController as CinemaCL;

    class RoomController{
       
        private $roomDB;
        private $cinemaDB;
        private $showDB;
        private $genreDB;
        private $cinemaCL;

        public function __construct()
        {
            $this->roomDB = new roomDB();
            $this->cinemaDB = new cinemaDB();
            $this->showDB = new ShowDB();
            $this->genreDB = new GenreDB();
            $this->cinemaCL = new CinemaCL();
            
        }

    
        public function ShowAddViewRoom($id_cinema, $message='', $success='')
        {
          require_once(VIEWS_PATH."room-add.php");
        }
        

        public function ShowListShowsView($idRoom){

            $showList = $this->showDB->GetByRoom($idRoom);
            $room = $this->roomDB->getOne($idRoom);
            $genreList = $this->genreDB->GetAll();
            if(!$showList){
                $state = false;
                $message = '¡No se han encontrado funciones en la sala '. $room->getRoomName() . '!';
            }
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

        public function ShowEditView($id_room){
            $room = $this->roomDB->getOne($id_room);

            require_once(VIEWS_PATH."room-edit.php");


        }

        public function EditOne($room_name, $price, $room_capacity, $id_room, $id_cinema){
            #var_dump($_POST);
            
            $modify = new Room();
            $modify->setIdRoom($id_room);
            $modify->setRoomName($room_name);
            $modify->setPrice($price);
            $modify->setRoomCapacity($room_capacity);
            $modify->setCinema($this->cinemaDB->GetOne($id_cinema));
            
            $this->roomDB->EditOne($modify);


            $this->cinemaCL->ShowListView();
            
        }
         public function DeleteOne($id_room){

            $this->showDB->DeleteOne($id_room);
            $this->roomDB->DeleteOne($id_room);

            $this->cinemaCL->ShowListView();
        }
    
}