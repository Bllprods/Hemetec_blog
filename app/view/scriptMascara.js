const email = document.getElementById("txtEmail");
const senha = document.getElementById("txtPsw1");
const senhaConf = document.getElementById("txtPsw2");
const msgEmailContainer = document.getElementById("msgEmail");
const msgConfS = document.getElementById("msgConfS");
const cadBtn = document.getElementById("cadBtn")

let emailValid = false;
let senhaValid = false;
let Csenha = false;

/* liberação de formulario */
function btnAtualiza(){
    if (emailValid && senhaValid && Csenha){
        cadBtn.disabled = false;
    } else {
        cadBtn.disabled = true;
    }
}

// verificar Email com regex

const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|outlook|hotmail|yahoo|ymail|etec(\.[a-z]{2})\.gov)\.(com|info|edu|org|gov|br)(\.[a-z]{2})?$/i;

// Função para testar o email com a Regex
const isValidEmail = (email) => emailRegex.test(email);

email.addEventListener("input", ()=>{
    
    // 1. Limpa a mensagem sempre que o usuário digita
    msgEmailContainer.textContent = "";
    msgEmailContainer.style.color = "initial";
    
    // Pega o valor atual e remove espaços em branco (boa prática)
    const emailValue = email.value.trim();

    // 2. Verifica se o campo não está vazio E se o formato é inválido.
    if (emailValue !== "" && !isValidEmail(emailValue)) {
        msgEmailContainer.textContent = "Email inválido. Utilize um provedor comum como Gmail, Outlook, Yahoo ou um dos domínios permitidos (Ex: nome@provedor.com).";
        msgEmailContainer.style.color = "red";
        emailValid = false;
    } else {
        emailValid = true;
    }
    btnAtualiza();
});

/* verificar senha */
const senhaNumeros = /\d{5,}/; //teste se há ao menos 5 numeros
const senhaC = /[a-zA-Z]{3}/; //teste se há ao menos 3 letras(M ou m)
const senhaLmin = /[a-z]{1}/; //teste se há ao menos 1 letra minuscula
const senhaLMa = /[A-Z]{1}/; //teste se há ao menos 1 letra maiuscula
const senhaS = /[\W_]/; // teste de simbolos especiais

const isValidSenha1 = (senha) => senhaNumeros.test(senha);
const isValidSenha2 = (senha) => senhaC.test(senha);
const isValidSenha3 = (senha) => senhaLmin.test(senha);
const isValidSenha4 = (senha) => senhaLMa.test(senha);
const isValidSenha5 = (senha) => senhaS.test(senha);
const isValidSenha6 = (senha) => senhaNumeros.test(senha)

senha.addEventListener("input", ()=>{
    // 1. Limpa a mensagem
    msgConfS.textContent = "";
    msgConfS.style.color = "initial";
    
    // Pega o valor atual e remove espaços em branco
    const senhaValue = senha.value.trim();

    if (senhaValue.length === 0 ) {
        return;
    }

    const num   = isValidSenha1(senhaValue);
    const le    = isValidSenha2(senhaValue);
    const min   = isValidSenha3(senhaValue);
    const mai   = isValidSenha4(senhaValue);
    const simb  = isValidSenha5(senhaValue);

    if (senhaValue.length <= 8 || !num || !le || !min || !mai || !simb){
        msgConfS.innerHTML = "Nivel de segurança muito baixo. <br>Considere usar ao menos: <br>-- 5 numeros<br> -- 3 letras(entre maiusculas e minusculas)<br> -- 1 caractere especial";
        msgConfS.style.color = "red";
        senhaValid = false;
    } else{
        msgConfS.innerHTML = "Senha Forte";
        msgConfS.style.color = "green";
        senhaValid = true;
    }
    btnAtualiza();
});
/* fim verificação senha */

/* verificação de igualdade */
senhaConf.addEventListener("input", ()=>{
    if (senha.value != senhaConf.value) {
        Csenha = false;
        msgConfS.innerHTML = "as senhas não coincidem!";
        msgConfS.style.color = "red";
    } else {
        msgConfS.innerHTML = "as senhas coincidem!";
        msgConfS.style.color = "green";
        Csenha = true;
    }
    btnAtualiza();
});


btnAtualiza();