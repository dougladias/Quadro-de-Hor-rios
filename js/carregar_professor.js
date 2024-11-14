document.addEventListener('DOMContentLoaded', () => {
    const listaProfessores = document.getElementById('lista-professores');
    const formProfessores = document.getElementById('form-professores');

    function atualizarListaProfessores() {
        fetch('../php/cadastro_professor.php') 
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(professores => {
                listaProfessores.innerHTML = ''; 
                if (professores.length === 0) {
                    listaProfessores.innerHTML = '<li>Nenhum professor cadastrado.</li>';
                } else {
                    professores.forEach(professor => {
                        const listItem = document.createElement('li');
                        listItem.textContent = professor.nome; 
                        listaProfessores.appendChild(listItem);
                    });
                }
            })
            .catch(error => console.error('Erro:', error));
    }

    // Carregar professores cadastrados ao iniciar
    atualizarListaProfessores();

    // Atualizar a lista após o envio do formulário
    formProfessores.addEventListener('submit', event => {
        event.preventDefault(); 

        const formData = new FormData(formProfessores);
        fetch('../php/cadastro_professor.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); 
        })
        .then(professores => {
            // Atualiza a lista com os professores recém-cadastrados
            atualizarListaProfessores(); 
        })
        .catch(error => console.error('Erro:', error));
    });
});
