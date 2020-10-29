<?php

namespace Models;
use Models/movie as MovieModel;


class showCinema{
    private $id_show_cinema;
    private $show_time;
    private $show_hour;
    private MovieModel $movie;

    public function __construct($id_show_cinema='', $show_time='', $show_hour='',  $movie= null)
	{
		$this->id_show_cinema = $id_show_cinema;
		$this->show_time = $show_time;
		$this->show_hour = $show_hour;
        $this->movie = $movie;
	}

    public function getIdShowCinema()
    {
        return $this->id_show_cinema;
    }

       public function setIdShowCinema($id_show_cinema)
    {
        $this->id_show_cinema = $id_show_cinema;
    }

    public function getShowTime()
    {
        return $this->show_time;
    }
 
    public function setShowTime($show_time)
    {
        $this->show_time = $show_time;
    }

   
    public function getShowHour()
    {
        return $this->show_hour;
    }

    public function setTime($show_hour)
    {
        $this->show_hour = $show_hour;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;
    }
}


