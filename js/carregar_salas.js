// Função para carregar as salas cadastradas
function carregarSalas() {
    fetch('../php/listar_salas.php')
        .then(response => response.json())
        .then(salas => {
            const tabelaSalas = document.getElementById('tabela-salas');

            salas.forEach(sala => {
                const row = tabelaSalas.insertRow();
                row.insertCell(0).textContent = sala.nome.toUpperCase();
                row.insertCell(1).textContent = sala.capacidade.toUpperCase();
                row.insertCell(2).textContent = sala.andar.toUpperCase();
            });
        })
        .catch(error => console.error('Erro ao carregar as salas:', error));
}

// Chama a função ao carregar a página
document.addEventListener('DOMContentLoaded', carregarSalas);