<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\ShowCinema as ShowCinema;
    use Models\CreditCard as CreditCard;
    use DateTime as DateTime;
    use DAO\Movie as MovieDao;

    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;
    use DAODB\showCinema as ShowCinemaDB;
    use DAODB\Cinema as CinemaDB;
    use DAODB\Room as RoomDB;
    use DAODB\Buy as BuyDB;
    use DAODB\User as UserDB;
    use DAODB\CreditCard as CreditCardDaoB;

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
  }

      


        public function ShowAddViewRoom($status = '')
        {
           require_once(VIEWS_PATH . "card-add.php");
        }

       public function mostrarTickets($id_buy)
       {
        




       }
      public function AddCreditCard($card_number, $propietary , $expiration, $id_user)
      {
        $CreditCard = new CreditCard();
        $CreditCard->setCardNumber($card_number);
        $CreditCard->setPropietary($propietary);
        $CreditCard->setExpiration($expiration);

        $status = $this->creditCardDB->Add($CreditCard,$id_user);

        if($status != 'error')
        {
          include_once(ROOT . VIEWS_PATH . 'buy-add.php');

        }
        else
        {
          $this->ShowAddViewRoom($status);
        }

      }

      
      public function ShowTicketView($id)
       { 

         
        if(isset($_SESSION['loggedUser'])){

          $email= $_SESSION['loggedUser']['email'];
          $user = $this->userDB->GetUserByEmail($email);

          if($user->getCreditCard() != null){
            $show = $this->showCinemaDB->GetOneById($id);

          
            include_once(ROOT . VIEWS_PATH . 'buy-add.php');
          }
          else
          {

            $this->ShowAddViewRoom($status);
          }
      }else
      {

               
      }
    
    }
 }

