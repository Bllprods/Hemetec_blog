<div id="Conteudo">
            
    <div id="formulario">
        <form method="post" action="router.php?action=cadastrar" enctype="multipart/form-data">
            <label for="ti">Título Geral</label>
            <input type="text" name="ti" id="ti" required>

            <label for="cont">Conteúdo</label>
            <textarea name="cont" id="cont" rows="5"></textarea>

            <label for="autor">autor <input type="text" name="autor" required></label>

            <label for="img">Imagem</label>
            <input type="file" name="img" id="img" accept="image/*" multiple>

            <button type="submit" class="publicar">Publicar</button>
        </form>
    </div>

    
    <div id="Previa">
        <h3>Pré-visualização</h3>
        <div></div>
        <div></div>
        <div></div>
    </div>