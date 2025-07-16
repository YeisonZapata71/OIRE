
<?php
require_once __DIR__ . '/../libraries/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../libraries/PHPMailer/SMTP.php';
require_once __DIR__ . '/../libraries/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactoController {
    public function index() {
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/contacto/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars($_POST['nombre']);
            $correo = htmlspecialchars($_POST['correo']);
            $asunto = htmlspecialchars($_POST['asunto']);
            $mensaje = nl2br(htmlspecialchars($_POST['mensaje']));

            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP de Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'aleyei.yz@gmail.com'; // remitente
                $mail->Password = 'tnmi dijl viqn xwfo'; // usa una contraseña de aplicación
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Correo remitente y destinatario
                $mail->setFrom('aleyei.yz@gmail.com', 'Formulario OIRË');
                $mail->addAddress('hapkidoka93@hotmail.com'); // destinatario

                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body    = "
                    <strong>Nombre:</strong> $nombre <br>
                    <strong>Correo:</strong> $correo <br><br>
                    <strong>Mensaje:</strong><br> $mensaje
                ";

                $mail->send();
                header("Location: index.php?controller=contacto&action=index&exito=1");
            } catch (Exception $e) {
                echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            }
        }
    }
}
