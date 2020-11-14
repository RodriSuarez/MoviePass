<?php
    namespace Models;
    use Models\UserProfile as UserProfile;
    use Models\UserRole as UserRole;
    use Models\CreditCard as CreditCard;

class user{
	private $id_user;
	private $email;
    private $pass;
    private $profile;
    private $role;
    private $credit_card;
    
	public function __construct($id_user = null , $email = '', $pass = '', $profile = null, $role = null, $credit_card = null)
	{
		$this->id_user = $id_user;
		$this->email = $email;
        $this->pass = $pass;
       if(!$profile)
            $this->profile = new UserProfile();
        else
            $this->profile = $profile;

         if(!$role)
            $this->role = new UserRole();
        else
            $this->role = $role;
        
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

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    public function getCreditCard()
    {
        return $this->credit_card;
    }

    public function setCreditCard($credit_card)
    {
        $this->credit_card = $credit_card;
    }
}
?>