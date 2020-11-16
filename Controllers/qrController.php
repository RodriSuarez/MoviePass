<?php

    namespace Controllers;
    use Models\Ticket as Ticket;

    class QrController{


    public function makeQr($ticket, $user){
          
            $dir = ROOT .VIEWS_PATH . 'img\qr\\';
            $show = $ticket->getShow_cinema();
            if(!file_exists(($dir)))
                mkdir($dir);
            
            $filename = $dir . $show->getMovie()->getTitle() . ' - '. $show->getRoom()->getRoomName() .' - ' 
            . $ticket->getNumberTicket() .'.png';
    
            $tam = 10;
            $level = 'H';
            $frameSize = 2;
            $content = 'Cine: ' . $show->getRoom()->getCinema()->getCinemaName() .'
            ';
            $content.= 'Sala: ' . $show->getRoom()->getRoomName() . '
            ';
    
           \QRcode::png($content, $filename, $level, $tam, $frameSize);

           // $this->sendMail($show, $filename, $_SESSION['loggedUser']['email']);
            return $filename;
        }


    }

?>