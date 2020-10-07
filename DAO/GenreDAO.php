<?php
    namespace DAO;
    use Models\Genre as Genre;

    class GenreDao
    {        
        private $genreList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/genre.json";
         
        }

        public function Add(Genre $genre)
        {
            $this->RetrieveData();
            
            array_push($this->genreList, $genre);

            $this->SaveData();
        }

        public function Delete($key)
        {
            $this->RetrieveData();
           // echo $key;
            unset($this->genreList[$key]);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->genreList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->genreList as $genre)
            {
                $valuesArray["id"] = $genre->getID();
                $valuesArray["name"] = $genre->getName();
           
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
     
        private function RetrieveData()
        {
            $this->genreList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $genre = new Genre();
                    $genre->setID($valuesArray["id"]);
                    $genre->setName($valuesArray["name"]);
                 

                    array_push($this->genreList, $genre);
                }
            }
        }

        public function getOne($id){

            $this->RetrieveData();
            foreach($this->genreList as $genre){
                if($genre->getId() == $id){
                    return $genre->getName();
                }
            }
        }
        
    }
?>