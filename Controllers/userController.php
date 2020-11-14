<?php
    
    namespace Controllers;
    
    //use DAO\UserDAO as userDao;

    use Models\user as UserModel;
    use Models\userProfile as UserProfile;
    use Models\userRole as UserRole;

    use Controllers\showCinemaController as ShowC;
    use DAODB\User as userDB;


    use Controllers\MovieController as MovieC;

    class UserController{
        
        //private $userDao;
        private $userDB;
        private $showController;
      

        public function __construct()
        {
            /*$this->userDao = new userDao();*/
            $this->showController = new ShowC();
            $this->userDB = new userDB();
           


        }

        public function ShowAddView($message, $success)
        {
            //$userList=$this->userDB->GetAll();
            require_once(VIEWS_PATH."register.php");
        }

          public function loginError($message, $success)
        {
            require_once(VIEWS_PATH. "register.php");

        }
        /*public function ShowProfileView($name)
        {
            $userList = $this->userDB->GetOne($name);
            require_once(VIEWS_PATH."user-profile.php");
        }
        */
        
        /*public function ShowEditView($name){

            $userList = $this->userDB->GetOne($name);
            require_once(VIEWS_PATH."user-edit.php");
        }
        */

  public function login($email1, $pass1){
          
    try{
            $user = $this->userDB->GetUserByEmail($email1);
            if((!$user)||($user->getPass()!= $pass1))
            {

                   $success = false; 
                $message= "Usuario y/o contraseña incorrecta";   
                $this->loginError($message, $success);
            
            }
            else 
            {
               
                $_SESSION['loggedUser']['email'] = $user->getEmail(); //crear funcion que retorne el nombre del usuario por el email, maybe
                
                if($user->getRole()->getDescription() === "admin"){
                    $_SESSION['loggedUser']['type'] = 'admin';
                }
                if($user->getRole()->getDescription() === "user"){
                    $_SESSION['loggedUser']['type'] = 'user';
                }
            }
        }catch(\Exception $e){
            $success = false; 
            $message= "No se ha podido acceder a la base de datos, intente nuevamente mas";   
        }
                 
                $this->showController->ShowListShowsView();
            
        }

        public function logout()
        {
            session_destroy();
            session_start();
            $this->showController->ShowListShowsView();
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
        
        public function ShowRegisterView(){

            require_once(ROOT.VIEWS_PATH."register.php");
        }
        public function Add($firstName, $lastName, $email, $dni, $pass)
        {   
            
               
              
            $userModel = new UserModel();
            $userProfile= new UserProfile();
            $userRole = new UserRole();

            $userModel->setEmail($email);
            $userModel->setPass($pass);

            $userModel->getProfile()->setFirstName($firstName);
            $userModel->getProfile()->setDni($dni);
            $userModel->getProfile()->setLastName($lastName);

            if((!$this->userDB->existDNI($dni)) && (!$this->userDB->existEmail($email))){
                $this->userDB->Add($userModel, $userProfile, $userRole);
                $success = true;  
            }
            else{
                   $success = false;          
            }
            if($success)
            {
                $message = 'Usuario creado con exito!';

            }
            else{
                $message = ' DNI - Email en uso!';
            }
            $this->ShowAddView($message, $success);
            

        }
    
    }


?>