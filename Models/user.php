<?php
    namespace Models;

class user{
	private $id_user;
	private $first_name;
	private $last_name;
	private $email;
	private $phone_number;
	private $pass;
    private $is_admin;
	
	public function __construct($id_user='',$first_name=' ', $last_name=' ', $email='', $phone_number='', $pass='', $is_admin='')
	{
		
		$this->id_user = $id_user;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->phone_number = $phone_number;
		$this->pass = $pass;
        $this->is_admin = $is_admin;
	}

    public function getIdUser()
    {
        return $this->id_user;
    }
  
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }  
  
    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }
   
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getPass()
    {
        return $this->pass;
    }

 
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }
}
?>