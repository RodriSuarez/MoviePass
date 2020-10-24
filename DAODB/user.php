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
                $query = "INSERT INTO ".$this->tableName." (id_user, first_name, last_name, email, phone_number, pass, is_admin)
                 VALUES (:id_user, :first_name, :last_name, :email, :phone_number, :pass, :is_admin);";
                
           
                $parameters["id_user"] = $user->getIdUser();
                $parameters["first_name"] = $user->getFirstName();
                $parameters["last_name"] = $user->getLastName();
                $parameters["email"] = $user->getEmail();
                $parameters["phone_number"] = $user->getPhoneNumber();
                $parameters["pass"] = $user->getPass();           
                $parameters["is_admin"] = $user->getIsAdmin();



                $this->connection = Connection::GetInstance();
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
                    $user->setFirstNAme($row["first_name"]);
                    $user->setLastName($row["last_name"]);
                    $user->setEmail($row["email"]);
                    $user->setPhoneNumber($row["phone_number"]);
                    $user->setPass($row["pass"]);
                    $user->setIsAdmin($row["is_admin"]);

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
    
    }