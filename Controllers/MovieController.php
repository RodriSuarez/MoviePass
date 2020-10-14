<?php
    namespace Controllers;

    use Models\movie as Movie;
    use DAO\movie as MovieDAO;
    use DAO\Genre as GenreDao;

    class MovieController{

        private $movieDao;
        private $genreList;

        public function __construct(){
            echo 'asd';
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