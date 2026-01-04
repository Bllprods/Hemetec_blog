<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<div id="Conteudo">
            
    <div id="formulario">
        <form method="post" action="router.php?action=cadastrar" enctype="multipart/form-data">
            <label for="ti">Título Geral</label>
            <input type="text" name="ti" id="ti" required>

            <label for="editor">Conteúdo</label>
            <textarea name="cont" id="editor" rows="5"></textarea>

            <!-- <select name="cat" id="">
                <option value="feiras-culturais">Feiras Culturais</option>
                <option value="jogos-educativos">Jogos Educativos</option>
                <option value="visitas-tecnicas">Visitas Técnicas</option>
                <option value="entrevistas">Entrevistas</option>
            </select> -->

            <label for="autor">Autor <input type="text" name="autor" required></label>

            <label for="img">Imagem</label>
            <input type="file" name="img" id="img" accept="image/*" multiple>
          
          	<label for="cat">Categoria</label>
          	<input type="text" name="cat" id="cat" required>

            <button type="submit" class="publicar">Publicar</button>
        </form>
    </div>

    
    <div id="Previa">
        <h3>Pré-visualização</h3>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
  <script src="../app/view/script.js"/>