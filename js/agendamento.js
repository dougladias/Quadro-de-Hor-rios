document.addEventListener('DOMContentLoaded', () => {
    const dadosSalvos = localStorage.getItem('solicitacao');
    const resultadoDiv = document.getElementById('resultado');
    const excluirButton = document.getElementById('excluir-button');

    if (dadosSalvos) {
        const dados = JSON.parse(dadosSalvos);
        document.getElementById('resultado-nome').textContent = dados.nome.toUpperCase();
        document.getElementById('resultado-disciplina').textContent = dados.disciplina.toUpperCase();
        document.getElementById('resultado-tipo').textContent = dados.tipo.toUpperCase();
        document.getElementById('resultado-data').textContent = dados.data.toUpperCase();
        document.getElementById('resultado-horario-inicio').textContent = dados.horarioInicio.toUpperCase();
        document.getElementById('resultado-horario-fim').textContent = dados.horarioFim.toUpperCase();
        document.getElementById('resultado-sala').textContent = dados.sala.toUpperCase();
        document.getElementById('resultado-justificativa').textContent = dados.justificativa.toUpperCase();
    } else {
        resultadoDiv.innerHTML = '<p>Nenhum dado disponível.</p>';
        excluirButton.style.display = 'none'; 
    }

    // Adiciona o evento para excluir os dados
    excluirButton.addEventListener('click', () => {
        localStorage.removeItem('solicitacao'); 
        resultadoDiv.innerHTML = '<p>A solicitação foi excluída.</p>'; 
        excluirButton.style.display = 'none'; 
    });
});