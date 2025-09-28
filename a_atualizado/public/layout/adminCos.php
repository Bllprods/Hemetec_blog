    <div id="Conteudo">
        <table name="tabela_consulta">
            <tr>
                <th>codigo da Noticia</th>
                <th>codigo da versão</th>
                <th>Titulo</th>
                <th>Conteudo</th>
                <th>Imagens</th>
                <th>Autor</th>
                <th>criada em:</th>
            </tr>
            <?php 
                require_once __DIR__ . "/../../app/model/postagemModel.php";
                $consulta = new postagemModel();
                $dadosBd = $consulta->consulta();
                if (empty($dadosBd)):?>

                    <tr>
                        <td colspan="8" style="text-align:center;">
                            <pre>SEM POSTAGENS</pre>
                        </td>
                    </tr>
                <?php else:

                    // $json_dados = json_encode($dadosBd, JSON_PRETTY_PRINT);
    
                    // echo "<h3>Representação JSON dos dados:</h3><br><br>";
                    // echo "<pre>"; // A tag <pre> preserva a formatação e os espaços
                    // var_dump($json_dados);
                    // echo "</pre>";
                    foreach ($dadosBd as $dados): ?>
            <?php
                // echo '<pre>'; // A tag <pre> formata a saída para ser mais legível no navegador
                // var_dump($dadosBd);
                // echo '</pre>';
            ?>

            <tr>
                <td>
                    <?php echo htmlspecialchars($dados['id_noticia']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($dados['id_versao']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($dados['titulo']); ?>
                </td>
                <td>
                    <a href="<?php echo htmlspecialchars($dados['txt_url']); ?>" download>Faça o download do arquivo TXT</a>
                </td>
                <td>
                    <?php if (!empty($dados['imagens'])): ?>
                        <?php foreach ($dados['imagens'] as $imagem): ?>
                            <img src="<?php echo htmlspecialchars($imagem['img_url']); ?>" alt="Imagem da Postagem" style="max-width: 150px;"/>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($dados['autor']); ?>
                </td> 
                <td>
                    <?php echo htmlspecialchars($dados['criado_em']); ?>
                </td>
                <td>
                    <form action="router.php?action=alt" method="post" >
                        <input type="hidden" name="id_versao" value="<?php echo htmlspecialchars($dados['id_versao']); ?>">
                        <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($dados['titulo']); ?>">
                        <input type="hidden" name="txt_url" value="<?php echo htmlspecialchars($dados['txt_url']); ?>">
                        <?php if (!empty($dados['imagens'])): ?>
                            <?php foreach ($dados['imagens'] as $imagem): ?>
                                <input type="hidden" name="img_url" value="<?php echo htmlspecialchars($imagem['img_url']); ?>"/>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Sem imagem
                        <?php endif; ?>
                        <button type="submit">Alterar</button>
                    </form>
                </td>
                <td>
                    <form action="router.php?action=excluir" method="post">
                        <button type="submit" name="idVer" value="<?php echo htmlspecialchars($dados['id_noticia']); ?>"> Excluir</form>
                    </form>
                </td>
            </tr>
            <?php endforeach; 
                endif?>
        </table>
    </div>