<?php
    namespace Controllers;

 #   use DAO\cinema as CinemaDao;
    use Models\Cinema as Cinema;
    use DAODB\cinema as cinemaDB;
 #   use DAODB\room as RoomDB;
    use Controllers\roomController as RoomC;

    class CinemaController{
        private $cinemaDB;
        #private $showC;
       # private $roomDB;
       # private $roomC;

        public function __construct()
        {
            $this->cinemaDB = new cinemaDB();
           # $this->roomC = new RoomC();
        }

        public function ShowAddView($message='', $success='')
        {
            $cinemaList=$this->cinemaDB->GetAll();
            require_once(VIEWS_PATH."cinema-add.php");
        }



        public function ShowListView()
        {
            $cinemaList = $this->cinemaDB->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowEditView($id_cinema){

            $cinema = $this->cinemaDB->GetOne($id_cinema);

            require_once(VIEWS_PATH."cinema-edit.php");
        }

        public function DeleteOne($id_cinema){
            $cinema = $this->cinemaDB->GetOne($id_cinema);

            if($cinema->getRooms()){
                foreach($cinema->getRooms() as $room){                   
                    
                    $this->roomC->DeleteOne($room->getIdRoom());
                }
            }
            $this->cinemaDB->DeleteOne($id_cinema);
            
            $this->ShowListView();
        }

        public function EditOneCinema($cinema_name, $address, $capacity, $id_cinema){
                     
            $modify = new Cinema();
            $modify->setCinemaName($cinema_name);
            $modify->setAddress($address);
            $modify->setCapacity($capacity);
            
            $this->cinemaDB->EditOne($id_cinema, $modify);

            $this->ShowListView();
            
        }

   
        public function Add($cinema_name, $address, $capacity='')
        {   
           
                
            $cinema = new Cinema();
            $cinema->setCinemaName($cinema_name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            
            if(!$this->cinemaDB->exist($cinema_name, $address)) {
                 $this->cinemaDB->Add($cinema);
                 $success=true;
             }
            else
                $success = false;
           
            if($success){
                $message = '¡Se ha agregado a ' . $cinema_name . ' con exito!';
                
            }else{
                $message = '¡Error inesperado! No se ha podido agregar a ' . $cinema_name;
            }
            

            $this->ShowAddView($message, $success);
        }
    }

?>