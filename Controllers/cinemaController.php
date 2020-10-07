<?php
    namespace Controllers;

    use DAO\cinemaDAO as CinemaDao;
    use models\cinema as Cinema;
   
    class CinemaController{
        private $cinemaDao;

        public function __construct()
        {
            $this->cinemaDao = new CinemaDao();
        }

        public function ShowAddView()
        {
            $cinemaList=$this->cinemaDao->GetAll();
            require_once(VIEWS_PATH."cinema-add.php");
        }



        public function ShowListView()
        {
            $cinemaList = $this->cinemaDao->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowEditView($name){

            $cinema = $this->cinemaDao->GetOne($name);
          //  var_dump($cinema);
            require_once(VIEWS_PATH."cinema-edit.php");
        }

        public function DeleteOne($key){

            $this->cinemaDao->DeleteOne($key);
            
            
            $this->ShowListView();
        }

        public function EditOneCinema($oldname, $name, $address, $capacity, $priceTicket=''){
                     
            
            $modify = new Cinema();
            $modify->setName($name);
            $modify->setAddress($address);
            $modify->setCapacity($capacity);
            $modify->setPriceTicket($priceTicket);
            
            
            $this->cinemaDao->EditOne($name, $modify);

            $this->ShowListView();
            
        }

        public function Add($name, $address, $capacity, $priceTicket)
        {   
           
                
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setPriceTicket($priceTicket);
            
            
            $this->cinemaDao->Add($cinema);
            

            $this->ShowAddView();
        }
    }

?>