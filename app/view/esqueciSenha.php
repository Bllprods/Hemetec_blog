<?php
  require_once __DIR__ . "/../../app/model/AdminModel.php";
  require_once __DIR__ . "/../../app/controller/sendEmail.php";
  require_once __DIR__ . "/../../app/controller/loginController.php";
  session_start();

  $consulta = new AdminModel();
  $sendEmail = new sendEmail();
  $contAdm = new logon();

  $dadosBd = $consulta->consultaAdm();
  $email = $_POST['email'] ?? '';
  $encontrou = false;

  if ($email) {
    foreach ($dadosBd as $dados) {
      if ($dados['email'] == $email && !empty($email)) {
        $_SESSION['codigo'] = $sendEmail->getCodigo();
        $_SESSION['emailA'] = $email;
        $encontrou = true;
        $sendEmail->send($email);
        //echo "<script> alert ('usuario encontrado');</script>";
        break;
      }
    }
    if (!$encontrou){
    	echo "<script> alert ('usuario não encontrado');</script>";
    }
  }
	

	$code = $_POST['code'];
	if ($code && $_SESSION['codigo']) {
      	if ($code === $_SESSION['codigo']){
        	echo "<script>
             		window.addEventListener('DOMContentLoaded', function() {
                      const codediv = document.getElementById('codediv');
                      const senhadiv = document.getElementById('senhadiv');
                      if (codediv && senhadiv) {
                          codediv.style.display = 'none';
                          senhadiv.style.display = 'block';
                      }
                    });
            	  </script>";
        }
    }
	
	$senha = $_POST['senha1'];
	$senha2 = $_POST['senha2'];
	if (!empty($senha) &&!empty($senha2)){
      if ($senha === $senha2){
          $contAdm ->esqueciSenha($_SESSION['emailA'], $senha);
          //echo"<script>alert('tentando alterar');</script>";
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
      
      <style>
        #codediv { display: none; }
        #senhadiv { display: none;}
      </style>;
</head>
<body>
  <div id="corpoRedSenha">
    <div id="LoginCard">
      <div id="emaildiv">
        <h1>Recuperação de conta</h1>
        <h3>Digite seu Email:</h3>
        <form method="post" action="">
          <input type="email" class="Input" name="email" id="email" required><br>
          <button type="submit">Verificar</button>
        </form>
      </div>

      <div id="codediv">
        <h1>Recuperação de conta</h1>
        <h3>Enviamos um código de verificação ao email digitado</h3>
        <p>Verifique a caixa de entrada e o spam, por garantia.</p>
        <form method="post" action="">
          <input type="text" class="Input" id="code" name="code" required maxlength="10"><br>
          <button type="submit">Verificar</button>
        </form>
      </div>
      
      <div id="senhadiv">
          <h1>Recuperação de conta</h1>
          <h3>Digite sua nova senha</h3>
          <form method="post" action="">
            <div>
              <label for="psw1">Nova senha</label>
              <input type="password" class="Input" id="psw1" name="senha1" required><br>

              <label for="psw2">Confirme a nova senha</label>
              <input type="password" class="Input" id="psw2" name="senha2" required><br>
              <p id="msgConfES"></p>
            </div>
            <button type="submit">Verificar</button>
          </form>
      </div>
    </div>
  </div>
  <?php
  	if ($encontrou) {
 		echo "<script>
    		document.getElementById('email').value = '';
  		</script>";
	}
  ?>
  <script src="../app/view/scriptMascara.js"></script>
</body>
</html>
