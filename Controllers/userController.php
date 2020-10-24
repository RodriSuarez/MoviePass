<?php
    
    namespace Controllers;
    
    //use DAO\UserDAO as userDao;
    use Models\user as User;
    use DAODB\User as userDB;

    class UserController{
        
        //private $userDao;
        private $userDB;


        public function __construct()
        {
            /*$this->userDao = new userDao();*/
            $this->userDB = new userDB();
        }

        public function ShowAddView()
        {
            $userList=$this->userDB->GetAll();
            require_once(VIEWS_PATH."register.php");
        }


        public function ShowProfileView($name)
        {
            $userList = $this->userDB->GetOne($name);
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function ShowEditView($name){

            $userList = $this->userDB->GetOne($name);
            require_once(VIEWS_PATH."user-edit.php");
        }
    
        public function login($email1, $pass1){
            
            $user = $this->userDB->GetOne($email1);

            if((!$user)&&($user->getPass()!=$pass1)){

                $message= "Usuario y/o contraseña incorrecta";   
                //REQUIRED (login.php) se tiene que preguntar si el message no esta vacio y si no se imprime
            }
            else{
               
                $movie= new MovieC();
                
                if($user->getIsAdmin()==true){
                $_SESSION['loggedUser']['first_name'] = $user->getFirstName();
                $movie->ShowListMoviesView();
                }

                else{
                $_SESSION['loggedUser']['first_name'] = $user->getFirstName();
                $movie->ShowListMoviesView();
                }
            }

        }

        public function logout()
        {
            session_destroy();
            require_once(ROOT.VIEWS_PATH."register.php");

        }

        /* (tanto delete como edite, faltan crear en DAO DB)
       
        public function DeleteOne($ .. ){ //determinar parametro

            $this->userDB->DeleteOne($ .. );
            
            
            $this->ShowProfileView();
        }

        public function EditOneUser($oldname, $firstName, $lastName, $email, $phoneNumber,$pass){
                     
            
            $modify = new User();
            $modify->setFirstName($firstName);
            $modify->setLastName($lastName);
            $modify->setEmail($email);
            $modify->setPhoneNumber($phoneNumber);
            $modify->setPass($pass);
            
            
            $this->userDB->EditOne($name, $modify);

            $this->ShowProfileView();
            
        }
        */

        public function Add($firstName, $lastName, $email, $phoneNumber, $pass)
        {   
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setPhoneNumber($phoneNumber);
            $user->setPass($pass);
        
            $this->userDB->Add($user);

            $this->ShowAddView();
        }
    }

?>