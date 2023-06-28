<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $to = 'comercialconstruconceito@gmail.com';
  $subject = 'Nova mensagem de contato';

  $nome = $_POST['nome'];
  $whatsapp = $_POST['whatsapp'];
  $mensagem = $_POST['mensagem'];

  $message = "Nome: $nome\n";
  $message .= "WhatsApp: $whatsapp\n";
  $message .= "Mensagem:\n$mensagem";

  $headers = "From: $nome <$to>";

  if (mail($to, $subject, $message, $headers)) {
    echo '<div class="success-message">Mensagem enviada com sucesso!</div>';
  } else {
    echo '<div class="error-message">Desculpe, ocorreu um erro ao enviar a mensagem.</div>';
  }
}
?>
