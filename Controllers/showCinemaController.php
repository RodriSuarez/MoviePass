<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\ShowCinema as ShowCinema;

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
        public function Add(){

    
            if(isset($_GET)){
            
                $cinema = new ShowCinema();
                $cinema->setShowTime($_GET['date']);
                $cinema->setShowHour($_GET['hora']);
                $cinema->setMovie($this->movieDB->getOneById($_GET['movieId']));
                
                $result = $this->showCinemaDB->Add($cinema, $_GET['roomId']);

                if($result){
                    $message = "¡Se ha añadido la funcion correctamente!";
                }else{
                    $message = "¡Error al cargar la funcion!";

                }
                $showList = $this->showCinemaDB->GetAll();

                require_once(ROOT. VIEWS_PATH . 'show-list.php');

            }
        }

        public function ShowListShowsView(){
            $genreList = $this->genreDao->GetAll();
            $showList = $this->showCinemaDB->GetAll();
            $roomDB = $this->roomDB; //ToDo modificar esta parte, le estamos dando contro a la vista, ERROR
            require_once(ROOT. VIEWS_PATH . 'show-list.php');
            
        }

        public function ShowSearchShowsView(){

            if(isset($_GET['title'])){
                $title = $_GET['title'];
            }
       
            $movieList = $this->movieDB->SearchMovies($title);
            $genreList = $this->genreDao->GetAll();
            if(!$movieList){
                $movieList = $this->movieDB->getApiMoviesByName($title);
                $movieList = $this->movieDB->SearchMovies($title);
               
            }

            require_once(ROOT. VIEWS_PATH . 'show-list.php');
            
        }

        public function ShowByGenre($genre){
            if(isset($_GET['genre'])){
                $genre = $_GET['genre'];
            }
            $showList = $this->showCinemaDB->filterByGenre($genre);
            $genreList = $this->genreDao->GetAll();
            require_once(ROOT. VIEWS_PATH . 'show-list.php');


        }

        public function ShowByDate($date){
            if(isset($_GET['date'])){
                $date = $_GET['date'];
            }
            $showList = $this->showCinemaDB->filterByDate($date);
            $genreList = $this->genreDao->GetAll();
            require_once(ROOT. VIEWS_PATH . 'show-list.php');
        }

        public function ShowFilterList(){
            $genreList = $this->genreDao->GetAll();
          #  var_dump($_GET);
            if( (isset($_GET['date']) && !empty($_GET['date']))  || isset($_GET['genre']) && !empty($_GET['genre'])){    
                if(isset($_GET['date']) && !empty($_GET['date']) &&
                     isset($_GET['genre']) && !empty($_GET['genre']) ){
                    $showList = $this->showCinemaDB->filterByGengreXdate($_GET['genre'], $_GET['date']);
                    require_once(ROOT. VIEWS_PATH . 'show-list.php');
                }
                elseif (isset($_GET['date']) && !empty($_GET['date']))
                    $this->ShowByDate($_GET['date']);
                elseif (isset($_GET['genre']) &&  !empty($_GET['genre'])){
                    $this->ShowByGenre($_GET['genre']);
                        echo 'entra aca';
                    }
            }else{
                $this->ShowListShowsView();
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