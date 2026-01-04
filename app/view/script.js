// Espera o carregamento total da página
window.addEventListener('load', function () {
  // Inicializa o CKEditor
  if (document.getElementById("editor")) {
    CKEDITOR.replace("editor", {
      removePlugins: "image",
    });
  }

  const btnEnviar = document.getElementById("btnEnviar");
  if (btnEnviar && typeof enviarNoticia === 'function') {
    btnEnviar.addEventListener("click", enviarNoticia);
  }
});

// Pop-up do menu
const menuBtn = document.getElementById('menuBtn');
const popupMenu = document.getElementById('popupMenu');

if (menuBtn && popupMenu) {
  menuBtn.addEventListener('click', () => {
    popupMenu.style.display = popupMenu.style.display === 'block' ? 'none' : 'block';
  });

  window.addEventListener('click', (e) => {
    if (!menuBtn.contains(e.target) && !popupMenu.contains(e.target)) {
      popupMenu.style.display = 'none';
    }
  });
}

// Login modal
const btnEntrar = document.getElementById('btnEntrar');
const closeBtn = document.querySelectorAll('.closeBtn');
const corpoLogin = document.getElementById('CorpoLogin');

if (btnEntrar && corpoLogin) {
  btnEntrar.onclick = function () {
    corpoLogin.style.display = corpoLogin.style.display === 'block' ? 'none' : 'block';
  };
}

if (closeBtn && corpoLogin) {
  closeBtn.onclick = function() {
    corpoLogin.style.display = 'none';
  };
}

window.addEventListener('click', function(event) {
  if (corpoLogin && event.target === corpoLogin) {
    corpoLogin.style.display = 'none';
  }
});

// modal Red. de Senha
const redSenha = document.getElementById("redSenha");
const corpoRedSenha = document.getElementById("corpoRedSenha");
const codediv = document.getElementById("codediv");
const codeDisplay = getComputedStyle(codediv).display;
if (codeDisplay === "block"){

} else {
  window.addEventListener('click', function(event) {
    if (corpoRedSenha && event.target === corpoRedSenha) {
      corpoRedSenha.style.display = 'none';
    }
  });
}
if (redSenha && corpoRedSenha) {
  redSenha.onclick = function() {
  	corpoLogin.style.display = 'none';
   	corpoRedSenha.style.display = corpoRedSenha.style.display === 'block' ? 'none' : 'block';
  }
}
if (closeBtn && corpoRedSenha) {
  closeBtn.onclick = function() {
    corpoRedSenha.style.display = 'none';
  };
}

