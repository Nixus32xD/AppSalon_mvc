<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv as Dotenv;
$dotenv = Dotenv::createImmutable('../includes/.env');
$dotenv->safeLoad();

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        //Crear el objeto de mail version localhost
        // $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.mailtrap.io';
        // $mail->SMTPAuth = true;
        // $mail->Port = 2525;
        // $mail->Username = '8e2976aa37bd1c';
        // $mail->Password = '38bd8fbf5e4da8';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = "Confirma tu cuenta";

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola<strong> " . $this->nombre . "</strong> has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['SERVER_HOST'] ."/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a> </p>";
        $contenido .= "<p> Si tu no solicisaste esta cuenta, puedes ignorar este mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones()
    {

        //Crear el objeto de mail version localhost
        // $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.mailtrap.io';
        // $mail->SMTPAuth = true;
        // $mail->Port = 2525;
        // $mail->Username = '8e2976aa37bd1c';
        // $mail->Password = '38bd8fbf5e4da8';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = "Restablece tu password";

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola<strong> " . $this->nombre . "</strong> has solicitado restablecer tu password, sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['SERVER_HOST'] ."/recuperar?token=" . $this->token . "'>Restablecer Password</a> </p>";
        $contenido .= "<p> Si tu no solicisaste esta cuenta, puedes ignorar este mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}
