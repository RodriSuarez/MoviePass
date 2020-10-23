<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\Movie as MovieDao;
    use DAO\Genre as GenreDao;
    use DAODB\Movie as MovieDB;

    class MovieController{

        private $movieDao;
        private $genreList;
        private $movieDB;
        
        public function __construct(){
            $this->movieDao = new MovieDAO();
            $this->genreList = new GenreDao();
            $this->movieDB = new MovieDB();
        }

        public function ShowListMoviesViewAdm(){

       
            $movieList = $this->movieDB->GetAll();
            $genreList = $this->genreList;

            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');
            
        }
        public function ShowListMoviesViewClient(){

       
            $movieList = $this->movieDB->GetAll();
            $genreList = $this->genreList;

            require_once(ROOT. VIEWS_PATH . 'movie-latest-client.php');
            
        }

        public function ShowListMoviesView(){

       
            $movieList = $this->movieDB->GetAll();
            $genreList = $this->genreList;

            require_once(ROOT. VIEWS_PATH . 'movie-latest-no-login.php');
            
        }

        public function RefreshLastestMovies(){
            $this->movieDB->GetApiMovies();
            
            $movieList = $this->movieDao->GetAll();
            $genreList = $this->genreList;
            
            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');

        }

        public function addOneMovie($movieID){

            var_dump($this->movieDB->exist($movieID));
          /*  $newMovie = $this->movieDao->GetOne($movieID);
            $this->movieDB->Add($newMovie);*/
        }

        
        public function GetAll(){

            //$newMovie = $this->movieDao->GetOne($movieID);
            return $this->movieDB->GetAll();
        }
    }

?>