<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../imagens/logoIco.ico">
  <title>Termos de Uso - Hemetec</title>
  <link rel="stylesheet" href="../css/politica.css">
</head>

<body>
  <div class="layout">
    <!-- ====== Sumário lateral ====== -->
    <aside class="sumario">
      <h3>Navegação</h3>
      <ul>
        <li><a href="#introducao">1. Introdução</a></li>
        <li><a href="#responsabilidade">2. Responsabilidade dos Usuários</a></li>
        <li><a href="#direitos">3. Direitos Autorais e Propriedade Intelectual</a></li>
        <li><a href="#envio">4. Envio de Conteúdos</a></li>
        <li><a href="#links">5. Links Externos e Publicidade</a></li>
        <li><a href="#cadastro">6. Cadastro de Autores</a></li>
      </ul>
      <a class="voltar" href="../router.php">← Voltar ao site</a>
    </aside>

    <!-- ====== Conteúdo principal ====== -->
    <main class="container">
      <section class="politica-privacidade">
        <h1>Termos de Uso do Hemetec</h1>
        <p><em>Última atualização: 17 de outubro de 2025</em></p>

        <h2 id="introducao">1. Introdução</h2>
        <p>O Hemetec descreve nesta página os direitos e obrigações dos usuários que interagem com sua plataforma digital. Ao acessar o site, o visitante concorda integralmente com estes Termos de Uso, devendo ler atentamente cada item antes de utilizar os serviços.</p>

        <h2 id="responsabilidade">2. Responsabilidade dos Usuários</h2>
        <p>Os usuários são responsáveis por manter os equipamentos e conexões necessários para acessar o Hemetec de forma segura. Em casos de incompatibilidade de software, falhas de provedor de internet ou outros motivos técnicos, o Hemetec não poderá ser responsabilizado pela impossibilidade de acesso.</p>

        <p>Os usuários também assumem responsabilidade por acessos a links externos presentes nas postagens, conforme disposto em nossa <a href="Politica.php">Política de Privacidade</a>, isentando o Hemetec de qualquer responsabilidade por uso indevido, interpretação ou aplicação incorreta das informações obtidas.</p>

        <h2 id="direitos">3. Direitos Autorais e de Propriedade Intelectual</h2>
        <p>Todo o conteúdo publicado nas plataformas do Hemetec — incluindo textos, vídeos, fotografias, imagens, sons, trilhas e logomarcas — é protegido por direitos autorais e legislação de propriedade intelectual.</p>

        <p>Ao acessar o site, o usuário compromete-se a respeitar tais direitos, inclusive de terceiros. É proibida a reprodução, distribuição ou divulgação de qualquer conteúdo sem a devida citação da fonte e autorização prévia.</p>

        <h2 id="envio">4. Envio de Conteúdos</h2>
        <p>Os conteúdos enviados ao Hemetec (como postagens e blogs) devem seguir as normas e critérios definidos pela equipe responsável. O autor garante que o material enviado é original e não viola direitos autorais, de imagem ou de personalidade de terceiros.</p>

        <p>Todo conteúdo publicado torna-se parte integrante do acervo do Hemetec. O autor é o único responsável por eventuais prejuízos causados por informações incorretas, ilegais ou que desrespeitem as leis brasileiras.</p>

        <h2 id="links">5. Links Externos e Publicidade</h2>
        <p>O Hemetec pode conter links para sites externos, bem como anúncios de parceiros. O portal não se responsabiliza pelo conteúdo, políticas ou práticas de privacidade de terceiros.</p>

        <h2 id="cadastro">6. Cadastro de Autores</h2>
        <p>Para criar postagens, o usuário deve solicitar permissão à professora Mara, que criará uma conta específica. O autor é responsável pela veracidade das informações publicadas e pelo respeito às normas éticas e legais.</p>

        <p>Postagens que contenham falas criminosas, desinformação ou ofensas serão removidas, e o autor poderá ter sua conta suspensa. O Hemetec poderá emitir notas de repúdio sempre que necessário para preservar a integridade do projeto.</p>

        <footer>
          <p>© 2025 Hemetec — Todos os direitos reservados.</p>
        </footer>
      </section>
    </main>
  </div>

  <!-- ====== Rolagem suave ====== -->
  <script>
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const alvo = document.querySelector(this.getAttribute('href'));
        if (alvo) {
          window.scrollTo({
            top: alvo.offsetTop - 20,
            behavior: 'smooth'
          });
        }
      });
    });
  </script>
</body>
</html>
