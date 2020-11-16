<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use Models\ShowCinema as ShowCinema;
    use Models\CreditCard as CreditCard;
    use DateTime as DateTime;

    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;
    use DAODB\showCinema as ShowCinemaDB;
    use DAODB\Cinema as CinemaDB;
    use DAODB\Room as RoomDB;
    use DAODB\Buy as BuyDB;
    use DAODB\User as UserDB;
    use DAODB\CreditCard as CreditCardDaoB;
    use DAODB\Ticket as TicketDB;
    use Models\Ticket as Ticket;

class TicketController{

        private $roomDB;
        private $genreDao;
        private $movieDB;
        private $cinemaDB;
        private $showCinemaDB;
        private $buyDB;
        private $userDB;
        private $creditCardDB;



        public function __construct()
        {
          $this->roomDB = new RoomDB();
          $this->genreDao = new GenreDao();
          $this->movieDB = new MovieDB();
          $this->cinemaDB = new CinemaDB();
          $this->showCinemaDB = new showCinemaDB();
          $this->buyDB = new BuyDB();
          $this->userDB = new UserDB();
          $this->creditCardDB = new creditCardDaoB();
          $this->creditCardDB = new creditCardDaoB();

        }


        public function controlTicket($ticket, $id_show, $id_room='', $price='', $creditcard=''){

            $show = $this->showCinemaDB->GetOneById($id_show);
            
            if($show->getRemaining_tickets() >= $ticket){
                        
                        $user = $this->userDB->GetOneById($_SESSION['loggedUser']['id']);
                        $qrCont = new QrController();
                        $newTicket = new Ticket();
                        $newTicket->setShow_cinema($show);

                        $qr = $qrCont->makeQr($newTicket, $user);

                        $newTicket->setQr($qr);
                        


            }



        }




    }









?>