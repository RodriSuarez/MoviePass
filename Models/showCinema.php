<?php

namespace Models;



class showCinema{
private $id_function;
private $date;
private $time; 
private $room;
private $cinema;

public function __construct($id_function='', $date='', $time='', $room='')
	{
		$this->id_function = $id_function;
		$this->date = $date;
		$this->time = $time;
        $this->room = $room;
	}



  
    public function getIdFunction()
    {
        return $this->id_function;
    }

       public function setIdFunction($id_function)
    {
        $this->id_function = $id_function;

        return $this;
    }

 
    public function getDate()
    {
        return $this->date;
    }

 
    public function setDate($date)
    {
        $this->date = $date;

     
    }

   
    public function getTime()
    {
        return $this->time;
    }

 
    public function setTime($time)
    {
        $this->time = $time;

    }

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     *
     * @return self
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }
}


