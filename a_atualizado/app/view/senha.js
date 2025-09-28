document.addEventListener('DOMContentLoaded', () => {
    // 1. Seleciona os elementos do HTML que vamos manipular.
    const inputSenha = document.getElementById('senha');
    const SenhaError = document.getElementById('senha-error');

    // Adiciona um ouvinte de evento para cada tecla digitada no campo de
    inputSenha.addEventListener('input', (event) => {
        let SenhaValue = event.target.value;

        
        // 2. Validação: Checa se o valor original continha caracteres não-numéricos.
        // Se a string original for diferente da string 'limpa', significa que 
        // algo inválido foi digitado.
        if (SenhaValue.length > 4 && SenhaValue.length <8) {
            SenhaError.textContent = 'Digite uma senha mais forte.';
            SenhaError.style.display = 'block'; // Exibe a mensagem de erro
        } else {
            SenhaError.textContent = ''; // Limpa a mensagem de erro
            SenhaError.style.display = 'none'; // Esconde a mensagem
        }


        // 3. Aplica a máscara ao valor limpo.
        let formattedValue = '';
        for (let i = 0; i < cleanedValue.length; i++) {
            formattedValue += cleanedValue[i];
           }
    
        // 4. Limita o tamanho máximo da string para  caracteres.
        // O campo `maxlength` no HTML também ajuda nisso, mas a lógica aqui 
        // reforça a regra.
        if (formattedValue.length > 24) {
            formattedValue = formattedValue.substring(0, 24);
        }
        
        // 5. Atualiza o valor do campo de input com a máscara aplicada.
        event.target.value = formattedValue;
    });
    // Opcional: Adiciona um ouvinte para quando o campo perde o foco.
    // Isso garante que a mensagem de erro desapareça caso o 
    // usuário saia do campo sem corrigir.
    inputSenha.addEventListener('blur', () => {
        SenhaError.textContent = '';
        SenhaError.style.display = 'none';
    });
});