<?php

    namespace Models;

    use Models\Movie as Movie;

class showCinema{

    private $id;
    private $show_time;
    private $show_hour;
    private $movie;
    private $id_room;

    public function __construct($id='', $show_time='', $show_hour='', $movie = null, $id_room='')
	{
		$this->id = $id;
		$this->show_time = $show_time;
		$this->show_hour = $show_hour;
        $this->id_room = $id_room;
        $this->movie = $movie;

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

    public function setShowHour($show_hour)
    {
        $this->show_hour = $show_hour;
    }

    public function getIdRoom()
    {
        return $this->id_room;
    }

    public function setIdRoom($id_room)
    {
        $this->id_room = $id_room;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }
}


