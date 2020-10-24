<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\Movie as MovieDao;
    use DAODB\Genre as GenreDao;
    use DAODB\Movie as MovieDB;

    class MovieController{

        private $movieDao;
        private $genreDao;
        private $movieDB;
        
        public function __construct(){
            $this->movieDao = new MovieDAO();
            $this->genreDao = new GenreDao();
            $this->movieDB = new MovieDB();
        }

        public function UpdateGenres(){

            $this->genreDao->GetApiGenres();
            echo '<h1 class"text-white">Generos actualiados</h1>';
        }

        public function ShowListMoviesView(){

       
            $movieList = $this->movieDB->GetAll();
            $genreList = $this->genreDao->GetAll();
          # var_dump($movieList);
           
           // echo '<h1 class"text-white">'. $this->genreDao->getOne(14) .'</h1>';
            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');
            
        }

        public function ShowSearchMoviesView($title= ''){

            if(isset($_POST['busqueda'])){
                $title = $_POST['busqueda'];
            }
       
            $movieList = $this->movieDB->SearchMovies($title);
            $genreList = $this->genreDao->GetAll();
            //var_dump($movieList);
            if(!$movieList){
                $movieList = $this->movieDB->getApiMoviesByName($title);
                $movieList = $this->movieDB->SearchMovies($title);
               
            }

            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');
            
        }

        public function ShowByGenre($genre){
            
            $movieList = $this->movieDB->filterByGenre($genre);

            require_once(ROOT. VIEWS_PATH . 'movie-lastest.php');


        }

        public function RefreshLastestMovies($page='1'){
            
            $this->movieDB->GetApiMovies($page);
            
            $movieList = $this->movieDB->GetAll();
            //$genreList = $this->genreList;
            
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