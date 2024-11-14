// Função para carregar as salas cadastradas
function carregarSalas() {
    fetch('../php/listar_salas.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na rede ao buscar salas');
            }
            return response.json();
        })
        .then(salas => {
            const aulaSalaSelect = document.getElementById('aula-sala');
            // Limpar as opções existentes no select
            aulaSalaSelect.innerHTML = '<option value="">Selecione uma Sala</option>';

            salas.forEach(sala => {
                // Adiciona cada sala ao select
                const option = document.createElement('option');
                option.value = `${sala.nome} - ${sala.andar} - ${sala.capacidade}`;
                option.textContent = `${sala.nome.toUpperCase()} - ${sala.andar} Andar / ${sala.capacidade} Alunos`;
                aulaSalaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao carregar as salas:', error));
}

// Chama a função ao carregar a página
document.addEventListener('DOMContentLoaded', carregarSalas);












