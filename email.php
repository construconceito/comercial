<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir manualmente os arquivos necessários do PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Configurações do servidor SMTP
$smtpHost = 'smtp.titan.email';
$smtpPort = 587; // ou a porta que seu provedor de e-mail utiliza
$smtpUsuario = 'mana@conceitoconstrutora.com';
$smtpSenha = 'C0nstru23#mana';

// Verificar se os dados foram postados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $whatsapp = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Link do WhatsApp com o número fornecido
    $linkWhatsapp = 'https://api.whatsapp.com/send?phone=' . urlencode($whatsapp);

    // Instanciar o PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsuario;
        $mail->Password   = $smtpSenha;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtpPort;

        // Remetente
        $mail->setFrom($smtpUsuario, 'Mana');

        // Destinatário
        $mail->addAddress('comercialconstruconceito@gmail.com');

        // Configurar o endereço de resposta
        $mail->addReplyTo($email, $nome);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Mana - LandingPage';
        $mail->Body    = "Nome: $nome<br>WhatsApp: $whatsapp (<a href='$linkWhatsapp'>$whatsapp</a>)<br>Email: $email";

        // Enviar o e-mail
        $mail->send();
        header("Location: index.php?enviado=email-enviado");
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
} else {
    // Se não for POST, mostrar algum erro ou redirecionar
    echo "Método de requisição inválido.";
}
?>
