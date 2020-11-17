<?php
    namespace Controllers;
    use Models\Ticket as Ticket;

    class MailController{

        public function sendMail(Ticket $ticket, $sendingTo, $qr){
        
        require_once(ROOT.'PHPMailer\PHPMailer\PHPMailer.php');

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
              
                $mail->Subject = 'MoviePass '. $ticket->getShow_cinema()->getMovie()->getTitle();
                $mail->Body    = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                
                <head>
                
                    <![endif]-->
                    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
                    <!--[if gte mso 9]>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:AllowPNG></o:AllowPNG>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                <![endif]-->
                    <!--[if !mso]><!-- -->
                    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
                    <!--<![endif]-->
                    
                </head>
                
                <body>
                
                    <div class="es-wrapper-color">
                        <!--[if gte mso 9]>
                            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                                <v:fill type="tile" color="#eeeeee"></v:fill>
                            </v:background>
                        <![endif]-->
                        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="esd-email-paddings" valign="top">
                                        <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-stripe" esd-custom-block-id="7954" align="center">
                                                        <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p15t es-p15b es-p10r es-p10l" align="left">
                                                                        <!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]-->
                                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="282" align="left">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="es-infoblock esd-block-text es-m-txt-c" align="left">
                                                                                                        <h3 style="text-align: center; font-family: arial, helvetica\ neue, helvetica, sans-serif; "> '. $ticket->getShow_cinema()->getMovie()->getTitle().'</h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                       
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr></tr>
                                                <tr>
                                                    <td class="esd-stripe" esd-custom-block-id="7681" align="center">
                                                        <table class="es-header-body" style="background-color: #044767;" width="600" cellspacing="0" cellpadding="0" bgcolor="#044767" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p35t es-p35b es-p35r es-p35l" align="left">
                                                                        <!--[if mso]><table width="530" cellpadding="0" cellspacing="0"><tr><td width="340" valign="top"><![endif]-->
                                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame" width="340" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-m-txt-c" align="left">
                                                                                                        <h1 style="color: #ffffff; line-height: 100%; text-align: center;">MoviePass</h1>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <!--[if mso]></td><td width="20"></td><td width="170" valign="top"><![endif]-->
                                                                        <table cellspacing="0" cellpadding="0" align="right">
                                                                            <tbody>
                                                                                <tr class="es-hidden">
                                                                                    <td class="es-m-p20b esd-container-frame" esd-custom-block-id="7704" width="170" align="left">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-spacer es-p5b" align="center" style="font-size:0">
                                                                                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td style="border-bottom: 1px solid #044767; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                            
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-stripe" align="center">
                                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p40t es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-image es-p25t es-p25b es-p35r es-p35l" align="center" style="font-size:0"><a target="_blank" href="https://viewstripo.email/"><img src="https://tlr.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/67611522142640957.png" alt style="display: block;" width="120"></a></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p10b" align="center">
                                                                                                        <h2>¡Gracias por tu compra!</h2>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p15t es-p20b" align="left">
                                                                                                        <p style="font-size: 16px; color: #777777;">Te esperamos para disfrutar las mejores peliculas que te puedas imaginar.</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-stripe" align="center">
                                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p20t es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p10t es-p10b es-p10r es-p10l" bgcolor="#eeeeee" align="left">
                                                                                                        <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="80%">
                                                                                                                        <h4>Pelicula </h4>
                                                                                                                    </td>
                                                                                                                    <td width="20%">
                                                                                                                        <h4>' .$ticket->getShow_cinema()->getMovie()->getTitle() . '</h4>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="esd-structure es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p10t es-p10b es-p10r es-p10l" align="left">
                                                                                                        <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td style="padding: 5px 10px 5px 0" width="80%" align="left">
                                                                                                                        <p>Valor de la entrada</p>
                                                                                                                    </td>
                                                                                                                    <td style="padding: 5px 0" width="20%" align="left">
                                                                                                                        <p>$' . $ticket->getShow_cinema()->getRoom()->getPrice().'</p>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td style="padding: 5px 10px 5px 0" width="80%" align="left">
                                                                                                                        <p>Reserva</p>
                                                                                                                    </td>
                                                                                                                    <td style="padding: 5px 0" width="20%" align="left">
                                                                                                                        <p>$50</p>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="esd-structure es-p10t es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table style="border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;" width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p15t es-p15b es-p10r es-p10l" align="left">
                                                                                                        <table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="80%">
                                                                                                                        <h4>TOTAL</h4>
                                                                                                                    </td>
                                                                                                                    <td width="20%">
                                                                                                                        <h4>$'. ($ticket->getShow_cinema()->getRoom()->getPrice()+50).'</h4>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                  
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-stripe" esd-custom-block-id="7797" align="center">
                                                        <table class="es-content-body" style="background-color: #1b9ba3;" width="600" cellspacing="0" cellpadding="0" bgcolor="#1b9ba3" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p35t es-p35b es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p25t" align="center">
                                                                                                        <h2 style="color: #ffffff; font-size: 24px;">¡Felicidades, aca tenes tu entrada!</h2>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="esd-block-button es-p30t es-p15b es-p10r es-p10l" align="center"><span class="es-button-border"><a href="https://viewstripo.email/" class="es-button" target="_blank"><img src="cid:ticket" width="300" height="300" alt="img no disponible"></a></span></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-stripe" esd-custom-block-id="7684" align="center">
                                                        <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-structure es-p35t es-p40b es-p35r es-p35l" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-container-frame" width="530" valign="top" align="center">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                             
                                                                                                <tr>
                                                                                                    <td class="esd-block-text es-p35b" align="center">
                                                                                                        <p><b>' . $ticket->getShow_cinema()->getRoom()->getCinema()->getAddress() .'</b></p>
                                                                                                        <p><strong>'.$ticket->getShow_cinema()->getRoom()->getCinema()->getCinemaName().'</strong></p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
                
                </html>
                ';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                
                $message = 'Message has been sent';
            } catch (\Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        

        }   

    }
?>