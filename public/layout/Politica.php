<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../imagens/logoIco.ico">
  <title>Política de Privacidade - Hemetec</title>
  <link rel="stylesheet" href="../css/politica.css">
</head>

<body>
  <div class="layout">
    <!-- ====== Sumário lateral ====== -->
    <aside class="sumario">
      <h3>Navegação</h3>
      <ul>
        <li><a href="#introducao">1. Introdução</a></li>
        <li><a href="#coleta">2. Coleta e Uso de Informações</a></li>
        <li><a href="#cookies">3. Uso de Cookies</a></li>
        <li><a href="#compartilhamento">4. Compartilhamento de Dados</a></li>
        <li><a href="#seguranca">5. Segurança das Informações</a></li>
        <li><a href="#direitos">6. Direitos dos Usuários</a></li>
        <li><a href="#alteracoes">7. Alterações nesta Política</a></li>
        <li><a href="#contato">8. Contato</a></li>
      </ul>
      <a class="voltar" href="../router.php">← Voltar ao site</a>
    </aside>

    <!-- ====== Conteúdo principal ====== -->
    <main class="container">
      <section class="politica-privacidade">
        <h1>Política de Privacidade do Hemetec</h1>
        <p><em>Última atualização: 17 de outubro de 2025</em></p>

        <h2 id="introducao">1. Introdução</h2>
        <p>Esta Política de Privacidade descreve como o Hemetec coleta, usa, armazena e protege as informações pessoais dos visitantes e colaboradores do site. Nosso compromisso é garantir a transparência e a segurança dos dados de todos os usuários.</p>

        <h2 id="coleta">2. Coleta e Uso de Informações</h2>
        <p>O Hemetec pode coletar dados pessoais fornecidos voluntariamente pelos usuários, como nome, e-mail e informações de contato, utilizados exclusivamente para fins de comunicação, feedback e melhoria do conteúdo oferecido.</p>

        <h2 id="cookies">3. Uso de Cookies</h2>
        <p>Utilizamos cookies para aprimorar a experiência de navegação e compreender melhor o comportamento dos visitantes. O usuário pode, a qualquer momento, desativar os cookies nas configurações do seu navegador, embora isso possa limitar algumas funcionalidades do site.</p>

        <h2 id="compartilhamento">4. Compartilhamento de Dados</h2>
        <p>O Hemetec não compartilha dados pessoais com terceiros, exceto quando exigido por lei ou por ordem judicial. Em hipótese alguma vendemos ou alugamos informações dos usuários.</p>

        <h2 id="seguranca">5. Segurança das Informações</h2>
        <p>Empregamos medidas técnicas e administrativas para proteger os dados pessoais contra acessos não autorizados, uso indevido, perda ou alteração. No entanto, nenhum sistema é totalmente seguro, e o usuário deve adotar boas práticas de proteção digital.</p>

        <h2 id="direitos">6. Direitos dos Usuários</h2>
        <p>Os usuários têm direito a solicitar o acesso, correção ou exclusão de seus dados pessoais armazenados pelo Hemetec, conforme a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018).</p>

        <h2 id="alteracoes">7. Alterações nesta Política</h2>
        <p>Podemos atualizar esta Política periodicamente para refletir mudanças nas práticas do site ou em conformidade com a legislação vigente. A data da última atualização será sempre informada no início deste documento.</p>

        <h2 id="contato">8. Contato</h2>
        <p>Em caso de dúvidas ou solicitações relacionadas à privacidade, entre em contato pelo e-mail: <strong>contato@hemetec.com.br</strong>.</p>

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
