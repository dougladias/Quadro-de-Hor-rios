document.addEventListener('DOMContentLoaded', () => {
    const selectProfessor = document.getElementById('aula-professor');

    // Função para carregar professores
    function carregarProfessores() {
        fetch('../php/cadastro_professor.php') 
            .then(response => response.json())
            .then(professores => {
                selectProfessor.innerHTML = '<option value="">Selecione um Professor</option>'; 

                professores.forEach(professor => {
                    const option = document.createElement('option');
                    option.value = professor.nome.toUpperCase(); 
                    option.textContent = professor.nome.toUpperCase(); 
                    selectProfessor.appendChild(option);
                });
            })
            .catch(error => console.error('Erro:', error));
    }

    // Chama a função ao carregar a página
    carregarProfessores();
});
