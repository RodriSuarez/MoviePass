<?php

    use Models\Ticket as Ticket;

    class MailController{

        public function sendMail(Ticket $ticket, $sendingTo){
        
        
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;# SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'gmail-smtp-msa.l.google.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   =   true;                                   // Enable SMTP authentication
                $mail->Username   = 'noreply.moviepass@gmail.com';                     // SMTP username
                $mail->Password   = 'comision1';                               // SMTP password
                $mail->SMTPSecure = 'ssl';# PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                //Recipients
                $mail->setFrom('noreply.moviepass@gmail.com', 'Movie Pass');
                $mail->addAddress($sendingTo);     // Add a recipient

            $mail->addAttachment($qr);         // Add attachments
            $mail->AddEmbeddedImage($qr, 'ticket');

                $mail->isHTML(true);                                  // Set email format to HTML
              
                $mail->Subject = 'MoviePass '. $ticket->getShow()->getMovie()->getTitle();
                $mail->Body    = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                                    <div>
                                <h1 class="text-center">¡Llego tu entrada!</h1>
                                <p>¡Felicidades! Llego tu entrada para ver <b>'. $ticket->getShow()->getMovie()->getTitle() .'</b></p>
                            <img src="cid:ticket" alt="img no disponible">
                            <button type="btn btn-primary">Click Me!</button>
                            </div>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                
                $message = 'Message has been sent';
            } catch (\Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        

        }   

    }
?>