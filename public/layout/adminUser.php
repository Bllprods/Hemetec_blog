<div id="Conteudo">
    <div>
        <h2>Usuario:</h2>
        <?php
      		session_start();
          	$user = $_SESSION['nome'];
			$email = $_SESSION['email'];
			$tipo = $_SESSION['nivel_acesso'];
      
      		if ($tipo == 1){
             	$tipo = "Dono(a)"; 
            } else if ($tipo == 2){
				$tipo = "Administrador(a)";
            }
		?>
      <h3>nome: <?php echo htmlspecialchars($user); ?></h3>
      <h3>email: <?php echo htmlspecialchars($email); ?></h3>
      <h3>função: <?php echo htmlspecialchars($tipo); ?></h3>
	</div>
</div>