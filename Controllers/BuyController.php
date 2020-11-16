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

    class BuyController{

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

      


        public function ShowAddViewCard($id_user, $id_show, $message, $status = '')
        {
          var_dump($id_user);
           require_once(VIEWS_PATH . "card-add.php");

        }

       public function mostrarTickets($id_buy)
       {
        




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

