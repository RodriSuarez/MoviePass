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
            require_once(VIEWS_PATH."cinema-add.php");
        }



        public function ShowListView()
        {
            $cinemaList = $this->cinemaDao->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowEditView($name){

            $cinema = $this->cinemaDao->GetOne($name);
            require_once(VIEWS_PATH."cinema-edit.php");
        }

        public function EditOneCinema(){

            
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