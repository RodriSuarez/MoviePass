<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\ShowCinema as ShowCinema;
    use DateTime as DateTime;
    use DAO\Movie as MovieDao;

    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;
    use DAODB\showCinema as ShowCinemaDB;
    use DAODB\Cinema as CinemaDB;
    use DAODB\Room as RoomDB;
    use DAODB\Buy as BuyDB;

    class TicketController{

        private $roomDB;
        private $genreDao;
        private $movieDB;
        private $cinemaDB;
        private $showCinemaDB;
        private $buyDB;
        
        public function __construct(){
            $this->roomDB = new RoomDB();
            $this->cinemaDB = new CinemaDB();
            $this->genreDao = new GenreDao();
            $this->movieDB = new MovieDB();
            $this->showCinemaDB = new ShowCinemaDB();
            $this->buyDB= new BuyDB();
        }




       public function mostrarTickets($id_buy)
       {
        




       }

        }