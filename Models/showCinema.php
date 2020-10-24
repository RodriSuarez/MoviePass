<?php

namespace Models;



class showCinema{
private $id_show_cinema;
private $show_time;
private $show_hour;
private $id_movie;
private $id_room;

    public function __construct($id_show_cinema='', $show_time='', $show_hour='', $id_movie='', $id_room='')
	{
		$this->id_show_cinema = $id_show_cinema;
		$this->show_time = $show_time;
		$this->show_hour = $show_hour;
        $this->id_movie = $id_movie;
        $this->id_room = $id_room;
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

    public function getIdMovie()
    {
        return $this->id_movie;
    }

    public function setIdMovie($id_movie)
    {
        $this->id_movie = $id_movie;
    }

    public function getIdRoom()
    {
        return $this->id_room;
    }

    public function setIdRoom($id_room)
    {
        $this->id_room = $id_room;
    }
}


