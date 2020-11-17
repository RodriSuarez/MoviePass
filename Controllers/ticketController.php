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
use MailController;
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
        private $ticketDB;



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
          $this->ticketDB = new TicketDB();
        }


        public function controlTicket($id_show, $id_room='', $price='', $creditcard='', $buy='', $i){
          
                        $show = $this->showCinemaDB->GetOneById($id_show);
          
                        
                        $user = $this->userDB->GetOneById($_SESSION['loggedUser']['id']);
                        $qrCont = new QrController();

                       
                        
                        $newTicket = new Ticket();
                        $newTicket->setShow_cinema($show);
                        
                        $mail = new \Controllers\MailController();
                        $numberTicket = ($show->getRoom()->getRoomCapacity() - $show->getRemaining_tickets()  + $i + 1);                        
                        
                        $newTicket->setNumberTicket($numberTicket);
                        $newTicket->setBuy($buy);
                        $newTicket->setUser($this->userDB->GetOneById($_SESSION['loggedUser']['id']));
                        $qr = $qrCont->makeQr($newTicket, $user, $numberTicket);

                        $newTicket->setQr($qr);
                        $mail->sendMail($newTicket, $_SESSION['loggedUser']['email'], $qr);
                        var_dump($newTicket);
                        $this->ticketDB->Add($newTicket);

        }

    

  
}





?>