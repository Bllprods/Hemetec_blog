<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Cabecario.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Fontes.css">
    <link rel="stylesheet" href="css/Cores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="imagens/logoIco.ico">
	<title>Noticia</title>
</head>
<body>
	<?php 
		
		$headerPath = __DIR__ . "/../../public/layout/Header.php";
		if (file_exists($headerPath)) {
			include_once $headerPath;
		} else {
			error_log("Header não encontrado: $headerPath");
		}
		require_once __DIR__ . "/../../app/model/postagemModel.php";
		$consulta = new postagemModel();
		$dadosBd = $consulta->consulta();
			// $json_dados = json_encode($dadosBd, JSON_PRETTY_PRINT);

			// echo "<h3>Representação JSON dos dados:</h3><br><br>";
			// echo "<pre>"; // A tag <pre> preserva a formatação e os espaços
			// var_dump($json_dados);
			// echo "</pre>";
		$noticia = array_filter($dadosBd, function($dado){
			return $dado['id_noticia'] == $_GET['id'];
		});

		foreach ($noticia as  $dados):
	?>
	
<div id="Noticias">
		<div>
			<?php echo htmlspecialchars($dados['titulo']);?>
        </div>
       	<div id="NoticiaCorpo">
			<?php if (!empty($dados['imagens'])): ?>
				<?php foreach ($dados['imagens'] as $imagem): ?>
					<img src="../<?php  echo htmlspecialchars($imagem['img_url']); ?>" alt="Imagem da Postagem" style="max-width: 150px;"/>
				<?php endforeach; ?>
			<?php else: ?>
				Sem imagem
			<?php endif; ?>
     	<div id="Text1">
			<p><?php echo file_get_contents($dados['txt_url']); ?></p>
		</div>
     	 <!-- Lorem ipsum dolor sit amet. Qui vero dolorum est fugit 
			 quae eum incidunt voluptate est galisum dolorem? Qui 
			 nihil consequatur qui perspiciatis porro et velit illum. 
			 Qui culpa perferendis et architecto amet non nisi 
			 praesentium ut eveniet molestiae cum soluta sequi qui 
			 omnis ipsam est enim dolorem? Ut voluptatem 
			 voluptatem et explicabo facilis qui consequatur 
			 explicabo.
			  Lorem ipsum dolor sit amet. Qui vero dolorum est fugit 
			 quae eum incidunt voluptate est galisum dolorem? Qui 
			 nihil consequatur qui perspiciatis porro et velit illum. 
			 Qui culpa perferendis et architecto.
    	</div><br><br>
  			<div id="Imagem2"></div>
		<div id="Text2">
			 Lorem ipsum dolor sit amet. Qui vero dolorum est fugit 
			 quae eum incidunt voluptate est galisum dolorem? Qui 
			 nihil consequatur qui perspiciatis porro et velit illum. 
			 Qui culpa perferendis et architecto amet non nisi 
			 praesentium ut eveniet molestiae cum soluta sequi qui 
			 omnis ipsam est enim dolorem? Ut voluptatem 
			 voluptatem et explicabo facilis qui consequatur 
			 explicabo.
			  Lorem ipsum dolor sit amet. Qui vero dolorum est fugit 
			 quae eum incidunt voluptate est galisum dolorem? Qui 
			 nihil consequatur qui perspiciatis porro et velit illum. 
			 Qui culpa perferendis et architecto.
	</div> -->
</div>
			<?php endforeach; ?>
	<div id="RodapeNoticia">

	</div>
	<script>
		const Text1 = document.getElement('');
	</script>
</body>
</html>