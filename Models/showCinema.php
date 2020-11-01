<?php

    namespace Models;

    use Models\Movie as Movie;

class showCinema{

    private $id;
    private $show_time;
    private $show_hour;
    private $movie;
    private $room;

    public function __construct($id='', $show_time='', $show_hour='', $movie = null, $room='')
	{
		$this->id = $id;
		$this->show_time = $show_time;
		$this->show_hour = $show_hour;
        $this->room = $room;
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

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
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


