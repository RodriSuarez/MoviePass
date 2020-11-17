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


        public function controlTicket($id_show, $id_room='', $price='', $creditcard=''){
            var_dump($id_show);
            $show = $this->showCinemaDB->GetOneById($id_show);
            var_dump($show);
            if($show->getRemaining_tickets() >= $QuantTicket){
                        
                        $user = $this->userDB->GetOneById($_SESSION['loggedUser']['id']);
                        $qrCont = new QrController();
                        
                       
                        
                        $newTicket = new Ticket();
                        $newTicket->setShow_cinema($show);

                        $mail = new \Controllers\MailController();
                        

                        $qr = $qrCont->makeQr($newTicket, $user);

                        $newTicket->setQr($qr);
                        $mail->sendMail($newTicket, $_SESSION['loggedUser']['email'], $qr);
                        #$sendMail = //mandar mail

                        #ir a mensaje de exito y muestra de ticket + qr
                        

            }else{

                #mostrar mensaje de error y mandar de nuevo a buycontroller.
            }



        }




    }









?>