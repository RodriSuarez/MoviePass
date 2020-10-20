<?php

namespace Models;



class cinemaFunction{
private $id_function;
private $date;
private $time; 


	public function __construct($id_function, $date, $time)
	{
		$this->id_function = $id_function;
		$this->date = $date;
		$this->time = $time;
	}



    /**
     * @return mixed
     */
    public function getIdFunction()
    {
        return $this->id_function;
    }

    /**
     * @param mixed $id_function
     *
     * @return self
     */
    public function setIdFunction($id_function)
    {
        $this->id_function = $id_function;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }
}


