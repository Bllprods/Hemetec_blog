<div id="Conteudo">
<?php
    if (isset($_POST['id_versao']) && isset($_POST['titulo']) && isset($_POST['txt_url']) && isset($_POST['img_url'])) {
        $id_versao = $_POST['id_versao'];
        $titulo    = $_POST['titulo'];
        $txt_url   = $_POST['txt_url'];
        $img_url   = $_POST['img_url'];
        $autor     = $_POST['autor'];

        require_once __DIR__ . '/../../app/model/postagemModel.php'; 
        
        if (!empty($id_versao)) {
?>
    <div id="formulario">
        <form method="post" action="router.php?action=alterarPost" enctype="multipart/form-data">
            <input type="hidden" name="id_versao" value="<?php echo $id_versao; ?>">
            <input type="hidden" name="txt_url" value="<?php echo $txt_url; ?>"> <!--  Agora o caminho do .txt vai junto -->

            <label for="ti">Título</label>
            <input type="text" name="ti" id="ti" value="<?php echo $titulo; ?>">
            
            <label for="cont">Conteúdo</label>
            <textarea name="cont" id="cont" rows="5"><?php 
                if (file_exists($txt_url)) {
                    echo htmlspecialchars(file_get_contents($txt_url));
                } else {
                    echo htmlspecialchars($txt_url);
                }
            ?></textarea> 

            <label for="autor">Autor <input type="text" name="autor" required></label>

            <label for="imag">Imagem Atual</label>
            <!-- <img src="<?php echo $img_url;?>" style="max-width:200px;"><br> -->
            <input type="hidden" name="img_url" value="<?php echo $img_url; ?>"/>

            <label for="img">Imagem</label>      
            <input type="file" name="img" id="img"> 

            <label for="publicado"> Publicar</label>
            <input type="checkbox" name="publicado" value="1" <?php echo !empty($publicado) ? 'checked' : ''; ?>>
            
            <button type="submit" class="publicar">Alterar</button>
        </form>
    </div>
<?php 
        } else {
            echo "<p>Postagem com erro de versão!</p>";
        }
    } else {
        echo "<p>Notícia não encontrada<p>";
    }
?>
</div>
