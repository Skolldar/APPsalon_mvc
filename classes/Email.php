<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        //Crear el objeto del email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentass@appsalon.com');
        $mail->addAddress('cuenta@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confrimar tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>Has creado tu cuenta en Appsalon, solo debes confirmarla presionando el siguiente Enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, pero puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el Mail
        $mail->send();

    }

    public function enviarInstrucciones() {
           //Crear el objeto del email
           $mail = new PHPMailer();
           $mail->isSMTP();
           $mail->Host = $_ENV['EMAIL_HOST'];
           $mail->SMTPAuth = true;
           $mail->Port = $_ENV['EMAIL_PORT'];
           $mail->Username = $_ENV['EMAIL_USER'];
           $mail->Password = $_ENV['EMAIL_PASS'];
   
           $mail->setFrom('cuentass@appsalon.com');
           $mail->addAddress('cuenta@appsalon.com', 'AppSalon.com');
           $mail->Subject = 'Reestablece tu Password';
   
           // Set HTML
           $mail->isHTML(TRUE);
           $mail->CharSet = 'UTF-8';
   
           $contenido = "<html>";
           $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado Reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
           $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a> </p>";
           $contenido .= "<p>Si tu no solicitaste esta cuenta, pero puedes ignorar el mensaje</p>";
           $contenido .= "</html>";
   
           $mail->Body = $contenido;
   
           //Enviar el Mail
           $mail->send();
    }
}