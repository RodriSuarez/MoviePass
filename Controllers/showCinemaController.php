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
    
    class ShowCinemaController{

        private $roomDB;
        private $genreDao;
        private $movieDB;
        private $cinemaDB;
        private $showCinemaDB;
        
        public function __construct(){
            $this->roomDB = new RoomDB();
            $this->cinemaDB = new CinemaDB();
            $this->genreDao = new GenreDao();
            $this->movieDB = new MovieDB();
            $this->showCinemaDB = new ShowCinemaDB();
          
        }

        /*
        array (size=4)
  'movieId' => string '22' (length=2)
  'roomId' => string '1' (length=1)
  'date' => string '2020-10-30' (length=10)
  'hora' => string '08:06' (length=5)
        */
        public function Add($moveId, $roomId, $date, $finalDate, $time){

            $endShow = new DateTime($finalDate);
            $beginShow = new DateTime($date);
            
            if(isset($_GET)){
            
                if(strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) <= 0){
                    if(strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) == 0){
                        $cinema = new ShowCinema();
                        $cinema->setShowTime($beginShow->format('Y-m-d'));
                        $cinema->setShowHour($time);
                        $cinema->setMovie($this->movieDB->getOneById($moveId));
                        $cinema->setRoom($this->roomDB->getOne($roomId));
                        $statusShow = $this->checkShowsTime($cinema, $date, $finalDate);

                        if($statusShow){
                            $result = $this->showCinemaDB->Add($cinema, $roomId);
                         
                            }else{
                                $result = $this->showCinemaDB->Add($cinema, $roomId);
                                
                            }
                            $message = $result['message'];
                            $state = $result['state'];

                     }else{
                        while(strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) != 0){
                            $cinema = new ShowCinema();
                            $cinema->setShowTime($beginShow->format('Y-m-d'));
                            $cinema->setShowHour($time);
                            $cinema->setRoom($this->roomDB->getOne($roomId));
                            $cinema->setMovie($this->movieDB->getOneById($moveId));
                            $statusShows = $this->checkShowsTime($cinema, $beginShow->format('Y-m-d'), $finalDate);

                            $beginShow->modify('+1 day');

                            }
                            
                            if($statusShows){
                                $endShow = new DateTime($finalDate);
                                $beginShow = new DateTime($date);
                            while(strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) != 0){
                                $cinema = new ShowCinema();
                                $cinema->setShowTime($beginShow->format('Y-m-d'));
                                $cinema->setShowHour($time);
                                $cinema->setRoom($this->roomDB->getOne($roomId));
                                $cinema->setMovie($this->movieDB->getOneById($moveId));
                                

                                $result = $this->showCinemaDB->Add($cinema, $roomId);
                                $beginShow->modify('+1 day');
                        
                    
                                $message = $result['message'];
                                $state = $result['state'];
                            }
                        }
                    }
                }
            }else{
                $message = "Las fechas deben ser ascendentes para poder insertar las funciones";
                $state = false;
                
            }
                    $showList = $this->showCinemaDB->GetAll();
                    $genreList = $this->genreDao->GetAll();
                    require_once(ROOT. VIEWS_PATH . 'show-list.php');

                
            }
        
    


        public function ShowListShowsView($message='', $state=''){
            
            $genreList = $this->genreDao->GetAll();
            $showList = $this->showCinemaDB->GetAll();
      
            require_once(ROOT. VIEWS_PATH . 'show-list.php');
            
        }

        public function checkShowsTime(ShowCinema $show, $inicDate, $LastDate){

            
            $dif = date_diff(new DateTime($LastDate), new DateTime($inicDate));
           
           return $this->showCinemaDB->checkTime($show, $show->getRoom()->getIdRoom());

        }

        public function ShowSearchShowsView($title=''){

       
            $movieList = $this->movieDB->SearchMovies($title);
            $genreList = $this->genreDao->GetAll();
            if(!$movieList){
                $movieList = $this->movieDB->getApiMoviesByName($title);
                $movieList = $this->movieDB->SearchMovies($title);
               
            }

            require_once(ROOT. VIEWS_PATH . 'show-list.php');
            
        }

        public function ShowByGenre($genre = ''){
            
            $showList = $this->showCinemaDB->filterByGenre($genre);
            $genreList = $this->genreDao->GetAll();

            if(!$showList){
                $state = false;
                $message = '¡No se han encontrado funciones con el genero '. $genre. '!';
            }
            require_once(ROOT. VIEWS_PATH . 'show-list.php');


        }

        public function ShowByDate($date = ''){
            
            $showList = $this->showCinemaDB->filterByDate($date);
            $genreList = $this->genreDao->GetAll();

            if(!$showList){
                $state = false;
                $message = '¡No se han encontrado funciones con el fecha '. $date. '!';
            }
            require_once(ROOT. VIEWS_PATH . 'show-list.php');
        }


        public function ShowFilterList($date='', $genre='', $message='', $state = ''){
            
            $genreList = $this->genreDao->GetAll();
            
            if( (!empty($date) || !empty($genre) ) ){    
                if( !empty($date) && !empty($genre) ){
                    $showList = $this->showCinemaDB->filterByGengreXdate($genre, $date);

                    if(!$showList){
                        $state = false;
                        $message = '¡No se han encontrado funciones con el genero <strong>'. $genre . '</strong> el día '. $date .'!' ;
                    }
                    require_once(ROOT. VIEWS_PATH . 'show-list.php');
                }
                elseif (!empty($date))
                    $this->ShowByDate($date);
                elseif (!empty($genre)){
                    $this->ShowByGenre($genre);
                    }
            }else{
                $this->ShowListShowsView($message, $state);
            }

        }

        public function makeQr(){
            require_once(ROOT. 'phpqrcode/qrlib.php');
          
            $dir = ROOT .VIEWS_PATH . 'img\qr\\';
            $show = $this->showCinemaDB->GetOneById(1);
            if(!file_exists(($dir)))
                mkdir($dir);
            
            $filename = $dir . $show->getMovie()->getTitle() . ' - '.$show->getRoom()->getRoomName().'.png';
    
            $tam = 10;
            $level = 'H';
            $frameSize = 2;
            $content = 'Cine: ' . $show->getRoom()->getCinema()->getCinemaName() .'
            ';
            $content.= 'Sala: ' . $show->getRoom()->getRoomName() . '
            ';
    
           \QRcode::png($content, $filename, $level, $tam, $frameSize);

            $this->sendMail($show, $filename, $_SESSION['loggedUser']['email']);

        }

        public function sendMail(ShowCinema $show, $qr, $sendingTo){
       
      
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;# SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'gmail-smtp-msa.l.google.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   =   true;                                   // Enable SMTP authentication
                $mail->Username   = 'noreply.moviepass@gmail.com';                     // SMTP username
                $mail->Password   = 'comision1';                               // SMTP password
                $mail->SMTPSecure = 'ssl';# PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                //Recipients
                $mail->setFrom('noreply.moviepass@gmail.com', 'Movie Pass');
                $mail->addAddress($sendingTo);     // Add a recipient
            /*    $mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');*/

                // Attachments
            $mail->addAttachment($qr);         // Add attachments
            $mail->AddEmbeddedImage($qr, 'ticket');
            //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'MoviePass '. $show->getMovie()->getTitle();
                $mail->Body    = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                                    <div>
                                <h1 class="text-center">¡Llego tu entrada!</h1>
                                <p>¡Felicidades! Llego tu entrada para ver <b>'. $show->getMovie()->getTitle() .'</b></p>
                             <img src="cid:ticket" alt="img no disponible">
                             <button type="btn btn-primary">Click Me!</button>
                             </div>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        #     var_dump($mail);
                $mail->send();
                $message = 'Message has been sent';
            } catch (\Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            

        }

        public function ShowAddView($movieID){
            #var_dump($movieID);
            $cinemaList = $this->cinemaDB->GetAll();
            $roomList = $this->roomDB->GetAll();
            $newMovie = $this->movieDB->GetOneById($movieID);
          //  $showList = $this->showCinemaDB->GetAll();
            require_once(ROOT. VIEWS_PATH . 'show-add.php');

        }

        
  
    }
    

?>

<img src="" alt="">