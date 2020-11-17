<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use Models\Genre as GenreModel;

    class Genre
    {        
        private $connection;
        private $tableName = "genre";
 
        /**
         * CREATE TABLE IF NOT EXISTS genre(
        id_genre INT AUTO_INCREMENT NOT NULL,
        NAME VARCHAR(50) NOT NULL,
        id_api_genre INT NOT NULL,
        CONSTRAINT pk_genre PRIMARY KEY (id_genre),
        CONSTRAINT unq_id_api UNIQUE (id_api_genre)
);

         */
        public function Add(GenreModel $genre)
        {
            $query = "INSERT INTO ".$this->tableName." (name, id_api_genre)
            VALUES (:name, :id_api_genre);";
            
            
            
            $parameters["NAME"] = $genre->getName();
            $parameters["id_api_genre"] = $genre->getApi_id();
            
            try
            {
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

        
        public function GetApiGenres(){
           
    

            #$newArrivals = json_decode( file_get_contents(API_URL . NOW_PLAYING . API_KEY . LANGUAGE), true );
            #https://api.themoviedb.org/3/genre/movie/list?api_key=5c5be0bb9aae8be870e50088603452ef&language=en-US
          try{
            $newArrivals = json_decode(file_get_contents(API_URL . "/genre/movie/list?".API_KEY . LANGUAGE),true);
            foreach($newArrivals['genres'] as $genre){
                

                $joinGenre = new GenreModel();

                $joinGenre ->setName($genre['NAME']);
                $joinGenre ->setApi_id($genre['id']);

                

            
                if(!$this->exist($joinGenre->getApi_id())){
                   
                    $this->Add($joinGenre);
                   
                }

            }
        }catch(Exception $ex){
            throw $ex;
        }


        }

        
        public function exist($id){
            $query = "SELECT * FROM ".$this->tableName . " WHERE id_api_genre = " . $id .";";
            
            try
            {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                return $resultSet;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }

        
        public function GetAll()
        {
            $genreList = array();
            
            $query = "SELECT * FROM ".$this->tableName;
            
            try
            {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $genre = new GenreModel();
               
                    $genre->setName($row["name"]);
                    $genre->setApi_id($row["id_api_genre"]);
                    $genre->setId($row["id_genre"]);

                    array_push($genreList, $genre);
                }

                return $genreList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){

            $genreList = array();
            
            $query = "SELECT * FROM ".$this->tableName . " WHERE id_api_genre = " . $id ." ;";
            
            try
            {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                if(!empty($resultSet)){
                    $genre = new GenreModel();
                    $genre->setName($resultSet['0']["name"]);
                    $genre->setApi_id($resultSet['0']["id_api_genre"]);
                    $genre->setId($resultSet['0']["id_genre"]);
                    return $genre;
                }
                else return 'Genero no encontrado';
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
    }
?>