<div id="Conteudo">
    <table name="tabela_consulta">
        <a href="router.php?action=cadastro"><button type="submit" id="Correio" value="loginEmail"> Cadastrar Novo Administrador</button></a>
        <tr>
            <th>Nome de Usuario</th>
            <th>Email</th>
            <th>Função</th>
            <th>Status</th>
        </tr>
        <?php 
            require_once __DIR__ . "/../../app/model/AdminModel.php";
            $consulta = new AdminModel();
            $dadosBd = $consulta->consultaAdm();

            foreach ($dadosBd as $dados): ?>
        <?php
            // echo '<pre>'; // A tag <pre> formata a saída para ser mais legível no navegador
            // var_dump($dadosBd);
            // echo '</pre>';
        ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($dados['nome']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($dados['email']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($dados['nivel_acesso']); ?>
            </td>
            <td>
               <?PHP echo htmlspecialchars($dados['ativo'] ? 'Ativo' : 'Inativo'); ?>
            </td> 
            <td>
                <form action="router.php?action=altAdm" method="post">
                    <input type="hidden" name="idAdm" value="<?php echo htmlspecialchars($dados['id_adm']); ?>">
                    <input type="hidden" name="nomeAdm" value="<?php echo htmlspecialchars($dados['nome']);?>">
                    <input type="hidden" name="emailAdm" value="<?php echo htmlspecialchars($dados['email']);?>">
                    <button type="submit">Alterar</button>
                </form>
            </td>
            <td>
                <form action="router.php?action=excluirAdm" method="post">
                    <input type="hidden" name="idAdm" value="<?php echo htmlspecialchars($dados['id_adm']); ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>

        </tr>
        <?php endforeach; ?>
    </table>
</div>
