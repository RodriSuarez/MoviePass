<?php

    namespace Controllers;
    use Models\Ticket as Ticket;

    class QrController{


    public function makeQr($ticket, $user){
            require_once(ROOT. 'phpqrcode/qrlib.php');

            $dir = ROOT .VIEWS_PATH . 'img\qr\\';
            $show = $ticket->getShow_cinema();
            if(!file_exists(($dir)))
                mkdir($dir);
            
            $filename = $dir . $user->getIdUser() . $show->getMovie()->getId() .  $show->getRoom()->getIdRoom()  . $ticket->getNumberTicket() .'.png';
            $tam = 10;
            $level = 'H';
            $frameSize = 2;
            $content = 'Cine: ' . $show->getRoom()->getCinema()->getCinemaName() .'
            ';
            $content.= 'Sala: ' . $show->getRoom()->getRoomName() . '
            ';
        //agregar nombre de usuario, numero de ticket
           \QRcode::png($content, $filename, $level, $tam, $frameSize);

           // $this->sendMail($show, $filename, $_SESSION['loggedUser']['email']);
            return $filename;
        }


    }

?>