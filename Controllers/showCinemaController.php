<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\Movie as MovieDao;
    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;
    use DAODB\showCinema as ShowCinemaDao;

    class ShowCinemaController{

        private $movieDao;
        private $genreDao;
        private $movieDB;
        private $showCinemaDB;
        
        public function __construct(){
            $this->movieDao = new MovieDAO();
            $this->genreDao = new GenreDao();
            $this->movieDB = new MovieDB();
            $this->showCinemaDB = new ShowCinemaDao();
          
        }

    

        public function ShowListShowsView(){
            $genreList = $this->genreDao->GetAll();
            $showList = $this->showCinemaDB->GetAll();
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
                $title = $_GET['genre'];
            }
            $showList = $this->showCinemaDB->filterByGenre($genre);
            $genreList = $this->genreDao->GetAll();
            require_once(ROOT. VIEWS_PATH . 'show-list.php');


        }

        public function ShowByDate($date){
            if(isset($_GET['date'])){
                $title = $_GET['date'];
            }
            $showList = $this->showCinemaDB->filterByDate($date);
            $genreList = $this->genreDao->GetAll();
            require_once(ROOT. VIEWS_PATH . 'show-list.php');
        }

   

        public function addFunction($movieID){

            $newMovie = $this->showCinemaDB->GetOne($movieID);
            $this->showCinemaDB->Add($newMovie);
        }

        
  
    }

?>