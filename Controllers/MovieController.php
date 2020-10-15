<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\Movie as MovieDao;
    use DAO\Genre as GenreDao;

    class MovieController{

        private $movieDao;
        private $genreList;

        public function __construct(){
            $this->movieDao = new MovieDAO();
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