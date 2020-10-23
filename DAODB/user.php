<?php

namespace DAODB;

    use \Exception as Exception;
   
    use Models\user as UserModel;    
    use DAODB\Connection as Connection;

    class User 
    {

        private $connection;
        private $tableName = "user";

        public function Add(UserModel $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_user, firstName, lastName, email, phoneNumber, pass)
                 VALUES (:id_user, :firstName, :lastName, :email, :phoneNumber, :pass);";
                
           
                $parameters["id_user"] = $user->getIdUser();
                $parameters["firstName"] = $user->getFirstName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["email"] = $user->getEmail();
                $parameters["phoneNumber"] = $user->getPhoneNumber();
                $parameters["pass"] = $user->getPass();


                $this->connection = Connection::GetInstance();
               // print_r($parameters);
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

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
                    $user = new UserModel();
               
                    $user->setIdUser($row["id_user"]);
                    $user->setFirstNAme($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setEmail($row["email"]);
                    $user->setPhoneNumber($row["phoneNumber"]);
                    $user->setPass($row["pass"]);
                    $user->setIsAdmin($row["isAdmin"]);

                    array_push($userList, $user);
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
                    $user->setFirstNAme($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setEmail($row["email"]);
                    $user->setPhoneNumber($row["phoneNumber"]);
                    $user->setPass($row["pass"]);
                    $user->setIsAdmin($row["isAdmin"]);
                    return $user;
                }
                    else{
                        return null;
                    }
                }
            

            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        

    
        
        }