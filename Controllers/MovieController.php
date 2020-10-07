<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\MovieDao as MovieDao;
    use DAO\GenreDAO as GenreDao;

    class MovieController{

        private $movieDao;
        private $genreList;

        public function __construct(){
            
            $this->movieDao = new MovieDao();
            $this->genreList = new GenreDao();
        }

        public function ShowListMoviesView(){

       
            $movieList = $this->movieDao->GetAll();
            $genreList = $this->genreList;

            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');
        }

        public function RefreshLastestMovies(){
            $this->movieDao->GetApiMovies();
            
            $movieList = $this->movieDao->GetAll();
            $genreList = $this->genreList;
            
            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');

        }
    }

?>