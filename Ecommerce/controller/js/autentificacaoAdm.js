console.log("Script autentificacaoAdm.js carregado com sucesso!");

document.getElementById('loginForm').addEventListener('submit', function(event) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Expressão regular para validar o formato de um email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === '') {
        alert('Por favor, insira um email.');
        event.preventDefault();
    } else if (!emailRegex.test(email)) {
        alert('Por favor, insira um email válido.');
        event.preventDefault();
    } else if (password === '') {
        alert('Por favor, insira uma senha.');
        event.preventDefault();
    }
});

