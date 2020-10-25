<?php
    namespace Controllers;

    use DAO\cinema as CinemaDao;
    use Models\Cinema as Cinema;
    use DAODB\cinema as cinemaDB;
   
    class CinemaController{
        private $cinemaDB;

        public function __construct()
        {
            $this->cinemaDB = new cinemaDB();
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

        public function ShowEditView($id){

            $cinema = $this->cinemaDB->GetOne($id);
          //  var_dump($cinema);
            require_once(VIEWS_PATH."cinema-edit.php");
        }

        public function DeleteOne($key){

            $this->cinemaDB->DeleteOne($key);
            
            
            $this->ShowListView();
        }

        public function EditOneCinema($name, $address, $capacity, $priceTicket='',$id){
                     
            
            $modify = new Cinema();
            $modify->setName($name);
            $modify->setAddress($address);
            $modify->setCapacity($capacity);
            $modify->setId($id);
            
            var_dump($modify);
            
            $this->cinemaDB->EditOne($id, $modify);

            $this->ShowListView();
            
        }

   
        public function Add($cinema_name, $address, $capacity)
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