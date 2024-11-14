document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('solicitacao-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Obter os dados do formulário
        const nome = document.getElementById('nome').value;
        const disciplina = document.getElementById('disciplina').value;
        const tipo = document.getElementById('tipo').value;
        const data = document.getElementById('data').value;
        const horarioInicio = document.getElementById('horario-inicio').value;
        const horarioFim = document.getElementById('horario-fim').value;
        const sala = document.getElementById('sala').value;
        const justificativa = document.getElementById('justificativa').value;

        // Armazenar dados no localStorage
        const dados = {
            nome,
            disciplina,
            tipo,
            data,
            horarioInicio,
            horarioFim,
            sala,
            justificativa
        };

        localStorage.setItem('solicitacao', JSON.stringify(dados));

        // Redirecionar para a página de resultados
        window.location.href = '../pages/agendamento.html';
    });
});