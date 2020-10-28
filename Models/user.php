<?php
    namespace Models;

class user{
	private $id_user;
	private $email;
	private $pass;
	
	public function __construct($id_user = 0 , $email = ' ', $pass = ' ')
	{
		$this->id_user = $id_user;
		$this->email = $email;
		$this->pass = $pass;
	}

    public function getIdUser()
    {
        return $this->id_user;
    }
  
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }  
   
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getPass()
    {
        return $this->pass;
    }

}
?>