window.onload = function () { 
  CKEDITOR.replace("editor");
  document.getElementById("btnEnviar").addEventListener("click", enviarNoticia);
};

async function enviarNoticia() {
  const valor = CKEDITOR.instances.editor?.getData() || "";
  const titulo = prompt("Título da notícia (opcional):", "") || null;

  try {
const res = await fetch('../controller/save_news.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ titulo, conteudo: valor })
});


    const json = await res.json();

    if (res.ok && json.success) {
      alert('Notícia salva! ID: ' + json.id);
      // limpar editor se quiser:
      // CKEDITOR.instances.editor.setData('');
    } else {
      alert('Erro ao salvar: ' + (json.message || res.statusText));
    }
  } catch (err) {
    console.error(err);
    alert('Erro na requisição: ' + err.message);
  }
}
