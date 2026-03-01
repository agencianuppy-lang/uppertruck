document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const clienteForm = document.getElementById("cliente-form");
    const contrato = document.getElementById("contrato");
    
    // Esconder formulário de cliente e contrato inicialmente
    clienteForm.style.display = "none";
    contrato.style.display = "none";
    
    // Lógica de login
    document.getElementById("login-button").addEventListener("click", function () {
        // Implemente a lógica de autenticação aqui
        // Se o login for bem-sucedido, exiba o formulário do cliente
        loginForm.style.display = "none";
        clienteForm.style.display = "block";
    });
    
    // Lógica para gerar contrato
    document.getElementById("gerar-contrato").addEventListener("click", function () {
        // Coleta os dados do cliente e serviços selecionados
        const nome = document.getElementById("nome").value;
        const email = document.getElementById("email").value;
        const cpf = document.getElementById("cpf").value;
        const servicos = [];
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        checkboxes.forEach(function (checkbox) {
            servicos.push(checkbox.value);
        });
        
        // Gere o contrato com os dados coletados e exiba
        contrato.innerHTML = `
            <h2>Contrato</h2>
            <p><strong>Nome:</strong> ${nome}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>CPF:</strong> ${cpf}</p>
            <p><strong>Serviços:</strong> ${servicos.join(', ')}</p>
            <!-- Adicione o texto do contrato gerado aqui -->
            <input type="checkbox" id="aceitar-termos"> Eu aceito os termos de serviço<br>
            <button id="aceitar-contrato">ACEITAR</button>
        `;
        clienteForm.style.display = "none";
        contrato.style.display = "block";
    });
    
    // Lógica para enviar contrato por email
    document.getElementById("enviar-link").addEventListener("click", function () {
        const aceitouTermos = document.getElementById("aceitar-termos").checked;
        if (!aceitouTermos) {
            alert("Você deve aceitar os termos de serviço para continuar.");
            return;
        }
        // Implemente a lógica para enviar o contrato por email aqui
        // Gere uma URL única para o contrato e envie por email
        // Redirecione para uma página de sucesso
        // Redirecionar para a página de sucesso após o email ser enviado
        window.location.href = "sucesso.php";
    });
});
