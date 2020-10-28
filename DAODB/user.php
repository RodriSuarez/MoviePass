<?php
namespace DAODB;

    use \Exception as Exception;
   
    use Models\user as UserModel;    
    use Models\userProfile as UserProfile;        
    use Models\userRole as UserRole;    

    use DAODB\Connection as Connection;

    class User 
    {

        private $connection;
        private $tableName = "user";

        public function Add(UserModel $userModel, UserProfile $userProfile, UserRole $userRole)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_user, email, pass, first_name, dni, last_name,description)
                 VALUES (:id_user, :email, :pass, :first_name, :dni, :last_name, :description);";
                
           
                $parameters["id_user"] = $userModel->getIdUser();
                $parameters["email"] = $userModel->getEmail();
                $parameters["pass"] = $userModel->getPass();           

                $parameters["first_name"] = $userProfile->getFirstName();
                $parameters["dni"] = $userProfile->getDni();
                $parameters["last_name"] = $userProfile->getLastName();
                
                $parameters["description"] = $userRole->getDescription();



                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }
/*
        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                
                foreach ($resultSet as $row)
                {                
                    $userModel = new UserModel();
                    $userProfile = new UserProfile();
                    $userRole = new UserRole();

               
                    $userModel->setIdUser($row["id_user"]);
                    $userModel->setEmail($row["email"]);
                    $userModel->setPass($row["pass"]);

                    $userProfile->setFirstName($row["first_name"]);
                    $userProfile->setDni($row["dni"]);
                    $userProfile->setLastName($row["last_name"]);
                    
                    $userRole->setDescription($row["description"]);

                  //  array_push($userList, $user); ???
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       public function GetOne($email)
        {
            try
            {
  
                $query = "SELECT * FROM ".$this->tableName .' WHERE email = "'.$email.'";';
                $this->connection = Connection::GetInstance();
                $obj=$this->connection->Execute($query); 
                $user=null;
                if($obj)
                {
                    $row=$obj[0];
                    $user= new UserModel();
                    $user->setIdUser($row["id_user"]);
                    $user->setFirstNAme($row["first_name"]);
                    $user->setLastName($row["last_name"]);
                    $user->setEmail($row["email"]);
                    $user->setPhoneNumber($row["phone_number"]);
                    $user->setPass($row["pass"]);
                    $user->setIsAdmin($row["is_admin"]);
                    return $user;
                }
                else
                {
                    return null;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        */
        
        public function existEmail($email){
            try
            {
            

                $query = 'SELECT * FROM '.$this->tableName . ' WHERE email = "' . $email .'";';
                $this->connection = Connection::GetInstance();

                $resultEmail = $this->connection->Execute($query);

                return $resultEmail;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }
    
    }