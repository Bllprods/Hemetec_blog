<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
require 'PHPMailer/src/Exception.php'; 
require 'PHPMailer/src/PHPMailer.php'; 
require 'PHPMailer/src/SMTP.php'; 

class sendEmail{
  private $codigo;
  public function __construct() {
   		$this->codigo = "H-" . random_int(100000, 999999);
  }

  public function getCodigo(){
    	$code = $this->codigo;
    	return $code;
  }
  public function send($email){
       // Pega os dados do formulário 
      //$nome = $_POST['nome'] ?? 'Sem nome';
      $code = $this->codigo;
      //$email = $_POST['email'] ?? 'Sem e-mail';
      $mensagem = "<h3>há um requisição de recuperação de senha em sua conta " . $email . "<br> no nosso site: https://hemetec.com.br;
                  \n<br> se você não fez essa requisição apenas ignore este email, coloque o codigo aqui: https://hemetec.com.br/public/router.php?action=index&act=vfc \n <br></h3> <h2><center><b>Codigo: \n" . $code . "</b></center></h2>";
      $mail = new PHPMailer(true); 
      try { 
          // Configurações do servidor SMTP 
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com'; 
          $mail->SMTPAuth = true; 
          $mail->Username = '*************';
          $mail->Password = '*************'; 
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587; // Remetente e destinatário 
          $mail->setFrom($email, 'Formulário do Site'); 
          $mail->addAddress($email); 
          // Para quem o e-mail vai 
          // Conteúdo do e-mail 
          $mail->isHTML(true); 
          $mail->Subject = 'Hemetec'; 
          $mail->Body = "<h2>Nova requisição recebida</h2> <h2><p><b>E-mail:</b> {$email}</p></h2> <h2><p><b>Mensagem:</b><br>{$mensagem}</p></h2> "; 
          $mail->AltBody = "E-mail: {$email}\nMensagem: {$mensagem}"; 
          $mail->send(); 
          $msg = "enviado: {$mail->ErrorInfo}";
          header('Location: router.php?action=index&act=vfc');
          exit;
      } catch (Exception $e){ 
          $erromsg = "Erro ao enviar: {$mail->ErrorInfo}";
          $msg = "Erro ao enviar: {$mail->ErrorInfo}";
		  return false;
      }
  }
}