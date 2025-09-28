<div id="Conteudo">
    <div id="formulario">
        <h2>Alterar Dados do Administrador</h2>
        <?php
        if ( isset($_POST['idAdm']) && isset($_POST['nomeAdm']) && isset($_POST['emailAdm'])) {
            $id_adm = $_POST['idAdm'];
            $nome =$_POST['nomeAdm'];
            $email =$_POST['emailAdm'];

            require_once __DIR__ . '/../../app/model/AdminModel.php'; 

            if (!empty($id_adm)) {
        ?>
            <form action="router.php?action=alterarAdm" method="POST">
                
                <input type="hidden" name="id_adm" value="<?php echo $id_adm; ?>">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome;?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email;?>">

                <label for="nivel_acesso">Nível de Acesso:</label>
                <select id="nivel_acesso" name="nivel_acesso" required>
                    <option value="1" >Administrador/Dono(a)</option>
                    <option value="2" >Editor</option>
                </select>

                <button type="submit">Atualizar Administrador</button>
            </form>
        <?php
            } else {
                echo "<p>Administrador não encontrado.</p>";
            }
        } else {
            echo "<p>Nenhum ID de administrador foi enviado para alteração.</p>";
        }
        ?>
            
    </div>
</div>