<?php

namespace Controllers;

    class QrController{


        public function makeQr(){
            
          
            $dir = ROOT .VIEWS_PATH . 'img\qr\\';
            $show = $this->showCinemaDB->GetOneById(1);
            if(!file_exists(($dir)))
                mkdir($dir);
            
            $filename = $dir . $show->getMovie()->getTitle() . ' - '.$show->getRoom()->getRoomName().'.png';
    
            $tam = 10;
            $level = 'H';
            $frameSize = 2;
            $content = 'Cine: ' . $show->getRoom()->getCinema()->getCinemaName() .'
            ';
            $content.= 'Sala: ' . $show->getRoom()->getRoomName() . '
            ';
    
           \QRcode::png($content, $filename, $level, $tam, $frameSize);

           // $this->sendMail($show, $filename, $_SESSION['loggedUser']['email']);

        }

    }