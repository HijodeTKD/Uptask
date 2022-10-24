<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    
    public function enviarConfirmacion(){ //-Create an account email

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD']; //Necessary 2-step verification google account to obtain
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['MAIL_PORT'];

        //Email - Config
        $mail->setFrom($_ENV['MAIL_PASSWORD'], "Bienvenido a UPTASK");
        $mail->addAddress($this->email);
        
        $mail->isHTML(true);
        $mail->Subject = 'Confirma tu cuenta';
        $mail->CharSet = 'UTF-8';

        //Email - Content
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ",</strong></p>";
        $contenido .= "<p>Has creado tu cuenta en UPTASK, solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p><a href=" . $_ENV['SERVER_HOST'] . "/confirmar?token=". $this->token .">Confirmar Cuenta </a> </p>";
        $contenido .= "<p>Si no has creado una cuenta, puedes ignorar este correo.</p>";

        $mail->Body = $contenido;
        
        $mail->send();

    }

    public function enviarInstrucciones(){ //- Reset password Email

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD']; //Necessary 2-step verification google account to obtain
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['MAIL_PORT'];

        //Email - Config
        $mail->setFrom($_ENV['MAIL_USER'], "Bienvenido a UPTASK");
        $mail->addAddress($this->email);
        
        $mail->isHTML(true);
        $mail->Subject = 'Confirma tu cuenta';
        $mail->CharSet = 'UTF-8';
        
        //Email - Content
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ",</strong></p>";
        $contenido .= "<p>Puedes reestablecer tu contraseña desde el siguiente enlace: </p>";
        $contenido .= "<p><a href=". $_ENV['SERVER_HOST'] ."/reestablecer?token=". $this->token .">Reestablecer tu contraseña</a> </p>";
        $contenido .= "<p>Si no has solicitado reestablecer tu contraseña, puedes ignorar este correo.</p>";
        
        $mail->Body = $contenido;

        $mail->send();
    }
}

