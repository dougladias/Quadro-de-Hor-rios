// Função para fazer logout
document.getElementById('logoutButton').addEventListener('click', function() {
    // Limpar informações de sessão, se necessário
    localStorage.removeItem('token'); 

    // Exibir mensagem de logout (opcional)
    alert('Você saiu da página.');

    // Redirecionar para a página de login
    window.location.href = '../pages/index.html'; 
});

