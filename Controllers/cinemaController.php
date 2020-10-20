<?php
    namespace Controllers;

    use DAO\cinema as CinemaDao;
    use Models\Cinema as Cinema;
   
    class CinemaController{
        private $cinemaDao;

        public function __construct()
        {
            $this->cinemaDao = new CinemaDao();
        }

        public function ShowAddView($message='', $success='')
        {
            $cinemaList=$this->cinemaDao->GetAll();
            require_once(VIEWS_PATH."cinema-add.php");
        }



        public function ShowListView()
        {
            $cinemaList = $this->cinemaDao->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowEditView($id){

            $cinema = $this->cinemaDao->GetOne($id);
          //  var_dump($cinema);
            require_once(VIEWS_PATH."cinema-edit.php");
        }

        public function DeleteOne($key){

            $this->cinemaDao->DeleteOne($key);
            
            
            $this->ShowListView();
        }

        public function EditOneCinema($name, $address, $capacity, $priceTicket='',$id){
                     
            
            $modify = new Cinema();
            $modify->setName($name);
            $modify->setAddress($address);
            $modify->setCapacity($capacity);
            $modify->setPriceTicket($priceTicket);
            $modify->setId($id);
            
            var_dump($modify);
            
            $this->cinemaDao->EditOne($id, $modify);

            $this->ShowListView();
            
        }

   
        public function Add($name, $address, $capacity, $priceTicket)
        {   
           
                
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setPriceTicket($priceTicket);
            if(!$this->cinemaDao->exist($cinema)) 
                $success = $this->cinemaDao->Add($cinema);
            else
                $success = false;
           
            if($success){
                $message = '¡Se ha agregado a ' . $name . ' con exito!';
                
            }else{
                $message = '¡Error inesperado! No se ha podido agregar a ' . $name;
            }
            

            $this->ShowAddView($message, $success);
        }
    }

?>