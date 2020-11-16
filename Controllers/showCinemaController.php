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

class ShowCinemaController
{

    private $roomDB;
    private $genreDao;
    private $movieDB;
    private $cinemaDB;
    private $showCinemaDB;

    public function __construct()
    {
        $this->roomDB = new RoomDB();
        $this->cinemaDB = new CinemaDB();
        $this->genreDao = new GenreDao();
        $this->movieDB = new MovieDB();
        $this->showCinemaDB = new ShowCinemaDB();
    }


    public function Add($moveId, $roomId, $date, $finalDate, $time)
    {

        $endShow = new DateTime($finalDate);
        $beginShow = new DateTime($date);


        if (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) <= 0) {
            try {
                if (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) == 0) {
                    $result = $this->addOneMovie($moveId, $roomId, $date, $finalDate, $time);

                    $message = $result['message'];
                    $state = $result['state'];
                } else {

                    $result = $this->addMovies($moveId, $roomId, $date, $finalDate, $time);
                    $message = $result['message'];
                    $state = $result['state'];
                }
            } catch (\Exception $error) {
                $message = 'Se produjo un error al comunicarse con la base de datos.';
                $state = false;
                var_dump($error);
            }
        } else {
            $message = "Las fechas deben ser ascendentes para poder insertar las funciones";
            $state = false;
        }
        try {
            $showList = $this->showCinemaDB->GetAll();
            $genreList = $this->genreDao->GetAll();
        } catch (\Exception $error) {
            $message = 'Se produjo un error al comunicarse con la base de datos.';
            $state = false;
            
        } finally {
            //incluir vista de error
            require_once(ROOT . VIEWS_PATH . 'show-list.php');
        }
    }


    public function addOneMovie($moveId, $roomId, $date, $finalDate, $time)
    {
        $endShow = new DateTime($finalDate);
        $beginShow = new DateTime($date);


        if (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) <= 0) {
            if (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) == 0) {
                $cinema = new ShowCinema();
                $cinema->setShowTime($beginShow->format('Y-m-d'));
                $cinema->setShowHour($time);
                $cinema->setMovie($this->movieDB->getOneById($moveId));
                $cinema->setRoom($this->roomDB->getOne($roomId));
                $cinema->setRemaining_tickets($cinema->getRoom()->getRoomCapacity());
                $statusShow = $this->checkShowsTime($cinema, $date, $finalDate);

                if ($statusShow) {
                    $result = $this->showCinemaDB->Add($cinema, $roomId);
                    $result =  array(
                        'message' => "La pelicula " . $cinema->getMovie()->getTitle() . " ha sido agregada a la cartelera con exito!",
                        'state' => true
                    );
                } else {
                    $result =  array(
                        'message' => "Ya existe una funcion en esta fecha y/o no hay tiempo disponible",
                        'state' => false
                    );
                }
            }
        } else {
            $result = array(
                'message' => "La fecha inicial debe ser anterior a la fecha final",
                'state' => false
            );
        }
        return $result;
    }

    public function addMovies($moveId, $roomId, $date, $finalDate, $time)
    {
        $endShow = new DateTime($finalDate);
        $beginShow = new DateTime($date);


        while (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) != 0) {
            $cinema = new ShowCinema();
            $cinema->setShowTime($beginShow->format('Y-m-d'));
            $cinema->setShowHour($time);
            $cinema->setRoom($this->roomDB->getOne($roomId));
            $cinema->setMovie($this->movieDB->getOneById($moveId));
            $cinema->setRemaining_tickets($cinema->getRoom()->getRoomCapacity());
            $statusShows = $this->checkShowsTime($cinema, $beginShow->format('Y-m-d'), $finalDate);

            $beginShow->modify('+1 day');
        }

        if ($statusShows) {
            $endShow = new DateTime($finalDate);
            $beginShow = new DateTime($date);
            while (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) != 0) {
                $cinema = new ShowCinema();
                $cinema->setShowTime($beginShow->format('Y-m-d'));
                $cinema->setShowHour($time);
                $cinema->setRoom($this->roomDB->getOne($roomId));
                $cinema->setMovie($this->movieDB->getOneById($moveId));
                $cinema->setRemaining_tickets($cinema->getRoom()->getRoomCapacity());

                $result = $this->showCinemaDB->Add($cinema, $roomId);
                $beginShow->modify('+1 day');
            }
        }
        return $result;
    }

    public function checkAllShowsTime($beginShow, $endShow, $finalDate, $time, $roomId, $movieId)
    {

        while (strcmp($beginShow->format('d-m-Y'), $endShow->format('d-m-Y')) != 0) {
            $cinema = new ShowCinema();
            $cinema->setShowTime($beginShow->format('Y-m-d'));
            $cinema->setShowHour($time);
            $cinema->setRoom($this->roomDB->getOne($roomId));
            $cinema->setMovie($this->movieDB->getOneById($movieId));
            $cinema->setRemaining_tickets($cinema->getRoom()->getRoomCapacity());
            $statusShows = $this->checkShowsTime($cinema, $beginShow->format('Y-m-d'), $finalDate);

            $beginShow->modify('+1 day');
        }
    }



    public function ShowListShowsView($message = '', $state = '')
    {
        try {
            $genreList = $this->genreDao->GetAll();
            $showList = $this->showCinemaDB->GetAll();
        } catch (\Exception $error) {
            $message = 'Se produjo un error al comunicarse con la base de datos.';
            $state = false;
        } finally {
            require_once(ROOT . VIEWS_PATH . 'show-list.php');
        }
    }

    public function checkShowsTime(ShowCinema $show, $inicDate, $LastDate)
    {


        $dif = date_diff(new DateTime($LastDate), new DateTime($inicDate));

        return $this->showCinemaDB->checkTime($show, $show->getRoom()->getIdRoom());
    }

    public function ShowSearchShowsView($title = '')
    {

        try {
            $movieList = $this->movieDB->SearchMovies($title);
            $genreList = $this->genreDao->GetAll();
            if (!$movieList) {
                $movieList = $this->movieDB->getApiMoviesByName($title);
                $movieList = $this->movieDB->SearchMovies($title);
            }
        } catch (\Exception $error) {
            $message = 'Se produjo un error al comunicarse con la base de datos.';
            $state = false;
        } finally {
            require_once(ROOT . VIEWS_PATH . 'show-list.php');
        }
    }

    public function ShowByGenre($genre = '')
    {

        try {
            $showList = $this->showCinemaDB->filterByGenre($genre);
            $genreList = $this->genreDao->GetAll();

            if (!$showList) {
                $state = false;
                $message = '¡No se han encontrado funciones con el genero ' . $genre . '!';
            }
        } catch (\Exception $error) {
            $message = 'Se produjo un error al comunicarse con la base de datos.';
            $state = false;
        } finally {
            require_once(ROOT . VIEWS_PATH . 'show-list.php');
        }
    }


    public function ShowByDate($date = '')
    {
        try {
            $showList = $this->showCinemaDB->filterByDate($date);
            $genreList = $this->genreDao->GetAll();

            if (!$showList) {
                $state = false;
                $message = '¡No se han encontrado funciones con el fecha ' . $date . '!';
            }
        } catch (\Exception $error) {
            $message = 'Se produjo un error al comunicarse con la base de datos.';
            $state = false;
        } finally {
            require_once(ROOT . VIEWS_PATH . 'show-list.php');
        }
    }


    public function ShowFilterList($date = '', $genre = '', $message = '', $state = '')
    {

        $genreList = $this->genreDao->GetAll();

        if ((!empty($date) || !empty($genre))) {
            if (!empty($date) && !empty($genre)) {
                $showList = $this->showCinemaDB->filterByGengreXdate($genre, $date);

                if (!$showList) {
                    $state = false;
                    $message = '¡No se han encontrado funciones con el genero <strong>' . $genre . '</strong> el día ' . $date . '!';
                }
                require_once(ROOT . VIEWS_PATH . 'show-list.php');
            } elseif (!empty($date))
                $this->ShowByDate($date);
            elseif (!empty($genre)) {
                $this->ShowByGenre($genre);
            }
        } else {
            $this->ShowListShowsView($message, $state);
        }
    }



    public function ShowAddView($movieID)
    {
        #var_dump($movieID);
        $cinemaList = $this->cinemaDB->GetAll();
        $roomList = $this->roomDB->GetAll();
        $newMovie = $this->movieDB->GetOneById($movieID);
        //  $showList = $this->showCinemaDB->GetAll();
        require_once(ROOT . VIEWS_PATH . 'show-add.php');
    }
}
