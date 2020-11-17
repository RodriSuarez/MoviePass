<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\ShowCinema as ShowCinema;
    use Models\CreditCard as CreditCard;
    use Models\Buy as BuyModel;
    use DAO\Movie as MovieDao;


    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;
    use DAODB\showCinema as ShowCinemaDB;
    use DAODB\Cinema as CinemaDB;
    use DAODB\Room as RoomDB;
    use DAODB\Buy as BuyDB;
    use DAODB\User as UserDB;
    use DAODB\CreditCard as CreditCardDaoB;
    use DAODB\Ticket as TicketDB;
    use Controllers\TicketController as tController;

    class BuyController{

        private $roomDB;
        private $genreDao;
        private $movieDB;
        private $cinemaDB;
        private $showCinemaDB;
        private $buyDB;
        private $userDB;
        private $creditCardDB;
        private $ticketDB;
        private $ticketController;


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
    $this->ticketController = new tController();
  }

      


        public function ShowAddViewCard($id_user, $id_show, $message='', $status = '')
        {
          
           require_once(VIEWS_PATH . "card-add.php");

        }


      /*  public function ShowBuyList($id_user)
        {

        $ticketList=$this->ticketDB->GetTicketsByUser($id_user);
        $Buy = $this->buyDB->



        }*/

     public function controlBuy($id_show, $QuantTicket, $price, $id_card){
        $ticketList = array();
          $show = $this->showCinemaDB->GetOneById($id_show);


            if($show->getRemaining_tickets() >= $QuantTicket){

              $Buy = new BuyModel();
              $Buy->setCant_tickets($QuantTicket);
              $today = new \DateTime();
              $Buy->setDate($today->format('Y-m-d'));
              $Buy->setTotal($QuantTicket * $show->getRoom()->getPrice());
              $creditCard = $this->creditCardDB->GetById($id_card);
              $this->buyDB->Add($Buy);
              $Buy->setIdBuy($this->buyDB->getLastId());
              for( $i = 0; $i < $QuantTicket; $i++)
              {
                 $ticket = $this->ticketController->controlTicket($id_show, $show->getRoom()->getIdRoom(), $price, $creditCard, $Buy, $i);

                  array_push($ticketList, $ticket);
              }   

              $this->showCinemaDB->updateRemainingTicktes($QuantTicket, $show);


            }


       }  
       
      public function AddCreditCard($card_number, $propietary , $expiration, $id_user, $id_show)
      {
        $CreditCard = new CreditCard();
        $CreditCard->setNumber($card_number);
        $CreditCard->setPropietary($propietary);
        $CreditCard->setExpiration($expiration);
        $CreditCard->setUser($this->userDB->GetOneById($id_user));

        $status = $this->creditCardDB->Add($CreditCard,$id_user);

        if($status)
        {
          $this->ShowBuyView($id_show);

        }
        else
        {
          var_dump($status);
          $message = 'Error al intentar agregar la tarjeta, pruebe nuevamente';
          $this->ShowAddViewCard($id_user, $id_show, $message, false);
         
        }

      }

      
      public function ShowBuyView($id_show)
       { 

        if(isset($_SESSION['loggedUser'])){

          $user = $this->userDB->GetOneById($_SESSION['loggedUser']['id']);
          $creditList = $this->creditCardDB->GetAllByUserId($user->getIdUser());
            if($creditList){
              
              $show = $this->showCinemaDB->GetOneById($id_show);

              
              include_once(ROOT . VIEWS_PATH . 'buy-add.php');
          }
          else
          {
            $message = 'Agregue una tarjeta para poder continuar con la compra!';
            $this->ShowAddViewCard($_SESSION['loggedUser']['id'], $id_show, $message);
          }
      }

    
    }
 }

