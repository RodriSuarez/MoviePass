<?php 
    namespace Models;

class userProfile{

    private $first_name;
    private $dni;
	private $last_name;

    public function __construct($first_name = ' ', $dni = 0, $last_name = ' '){
        $this->first_name = $first_name;
        $this->dni = $dni;
        $this->last_name = $last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    } 

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

}
?>