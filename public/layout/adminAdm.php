<div id="Conteudo">
    <table name="tabela_consulta">
        <a href="router.php?action=cadastro">
          <button type="submit" id="Correio" class="botao" value="loginEmail"> 
            Cadastrar Novo Administrador
          </button>
      	</a><br>


        <tr>
            <th>Nome de Usuario</th>
            <th>Email</th>
            <th>Função</th>
            <th>Status</th>
            <th>Id</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        <?php 
            require_once __DIR__ . "/../../app/model/AdminModel.php";
            $consulta = new AdminModel();
            $dadosBd = $consulta->consultaAdm();

            foreach ($dadosBd as $dados): ?>
        <?php
            // echo '<pre>';
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
          <td> <?PHP echo htmlspecialchars($dados['id_adm']) ?></td>
            <td>
                <form action="router.php?action=altAdm" method="post">
                    <input type="hidden" name="idAdm" value="<?php echo htmlspecialchars($dados['id_adm']); ?>">
                    <input type="hidden" name="nomeAdm" value="<?php echo htmlspecialchars($dados['nome']);?>">
                    <input type="hidden" name="emailAdm" value="<?php echo htmlspecialchars($dados['email']);?>">
                    <button type="submit" class="botao">Alterar</button>
                </form>
            </td>
            <td>
                <form action="router.php?action=excluirAdm" method="post" class="formExc">
                    <input type="hidden" name="idAdm" value="<?php echo htmlspecialchars($dados['id_adm']); ?>">
                    <button type="submit" class="botao">Excluir</button>
                </form>
            </td>

        </tr>
        <?php endforeach; ?>
    </table>
    
      <script>
          const forms = document.querySelectorAll(".formExc");

          forms.forEach((form) => {
            form.addEventListener("submit", (e) => {
              const confirma = confirm("Realmente deseja excluir este registro?");
              if (!confirma) {
                e.preventDefault();
              }
            });
          });
      </script>
</div>
