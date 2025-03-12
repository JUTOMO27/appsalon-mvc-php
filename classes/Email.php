<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public  function __construct($nombre, $email, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';


        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ", </strong> tu cuenta en AppSalon ha sido creada correctamente pero todavía no hemos terminado. Entra el siguiente enlace para confirmarla y poder utilizar nuestros servicios.</p>";
        $contenido .= "<p> Clic aquí: <a href=". $_ENV['APP_URL'] ."/confirmar-cuenta?token=". $this->token . ">Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no has creado la cuenta, ignora este mensaje.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Restablece tu contraseña';


        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . ", </strong>Parece que has olvidado tu contraseña... Pero no pasa nada! Haz click en el enlace de mas abajo para poder restablecerla.</p>";
        $contenido .= "<p> Clic aquí: <a href=". $_ENV['APP_URL'] ."/restablecer?token=". $this->token . ">Restablecer contraseña</a></p>";
        $contenido .= "<p>Si no has intentado restablecer tu contraseña puede que alguien esté intentado hacerlo por ti, ponte en contacto con nosotros y crea una nueva para mas seguridad.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
}
?>