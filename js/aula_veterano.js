// Variáveis para gerenciar a rotação dos cards
let currentPage = 0;  
const cardsPerPage = 12;  
let allCards = [];  

// Função para carregar as aulas do servidor
async function loadCards() {
    try {
        // Fazendo a requisição para a API que retorna as aulas para hoje (manhã e tarde)
        const response = await fetch('../php/aula_veteranos.php');
        
        // Verificando se a resposta foi bem-sucedida
        if (!response.ok) {
            throw new Error('Erro ao carregar os dados das aulas. Status: ' + response.status);
        }

        // Pegando o conteúdo como texto
        const responseText = await response.text();
        console.log('Resposta bruta do PHP:', responseText);  

        let aulas;
        // Tentando fazer o parse do JSON
        try {
            aulas = JSON.parse(responseText);
            console.log('Resposta do PHP (JSON):', aulas);  
        } catch (e) {
            throw new Error('Erro ao processar a resposta JSON: ' + responseText);  
        }

        // Verificando se o PHP retornou a mensagem "Nenhuma aula disponível"
        if (aulas.message && aulas.message === 'Nenhuma aula disponível no momento.') {
            // Caso não haja aulas, exibe a mensagem no front-end
            const container = document.getElementById('card-container');
            container.innerHTML = '';  
            const noAulasMessage = document.createElement('div');
            noAulasMessage.className = 'message';
            noAulasMessage.innerHTML = '<p>Não há aulas disponíveis para hoje.</p>';
            container.appendChild(noAulasMessage);
            return;  
        }

        // Agora, acessamos diretamente as aulas retornadas no campo 'aulas' do PHP
        allCards = aulas.aulas || [];  
        console.log('Aulas carregadas:', allCards);  

        // Selecionando o container onde os cards serão inseridos
        const container = document.getElementById('card-container');
        container.style.opacity = '0'; 

        // Limpando o conteúdo existente do container
        setTimeout(() => {
            container.innerHTML = ''; 

            // Exibe apenas os cards de acordo com a página atual
            const startIndex = currentPage * cardsPerPage;  
            const endIndex = startIndex + cardsPerPage;  

            // Limitar as aulas à quantidade de cards por página
            const aulasParaExibir = allCards.slice(startIndex, endIndex);
            console.log('Aulas para exibir:', aulasParaExibir);  

            // Verifica se há aulas para exibir
            if (aulasParaExibir.length > 0) {
                aulasParaExibir.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'card';

                    const header = document.createElement('div');
                    header.className = 'card-header';
                    header.style.backgroundColor = item.curso_cor;
                    header.innerText = `${item.curso_nome.toUpperCase()}  ${item.modalidade.toUpperCase()}`;

                    const cardDetails = document.createElement('div');
                    cardDetails.className = 'card-details';
                    cardDetails.innerHTML = ` 
                        <p><strong>AULA:</strong> ${item.aula_nome.toUpperCase()}</p>
                        <p><strong>SALA:</strong> ${item.sala_nome.toUpperCase()} - ${item.sala_andar.toUpperCase()}° ANDAR</p>
                        <p><strong>PROFESSOR:</strong> ${item.professor_nome.toUpperCase()}</p>                        
                    `;

                    card.appendChild(header);
                    card.appendChild(cardDetails);
                    container.appendChild(card);
                });
            } else {
                // Caso não haja aulas retornadas
                const noAulasMessage = document.createElement('div');
                noAulasMessage.className = 'message';
                noAulasMessage.innerHTML = '<p>Não há aulas disponíveis para hoje.</p>';
                container.appendChild(noAulasMessage);
            }

            // Se faltar aulas para completar 12 cards, preencher com cards vazios
            const remainingCards = cardsPerPage - aulasParaExibir.length;
            for (let i = 0; i < remainingCards; i++) {
                const emptyCard = document.createElement('div');
                emptyCard.className = 'card empty';
                emptyCard.innerHTML = '<p>Esperando Aulas...</p>';
                container.appendChild(emptyCard);
            }

            // Restaurando a opacidade para exibir os novos cards
            container.style.opacity = '1';

            // Incrementa a página para a próxima carga de cards
            currentPage++;

            // Se ultrapassar o limite de cards disponíveis, resetamos para começar a rotação
            if (currentPage * cardsPerPage >= allCards.length) {
                currentPage = 0;  
            }

        }, 500);

    } catch (error) {
        console.error('Erro ao buscar dados:', error);
        alert('Erro ao carregar as aulas. Tente novamente mais tarde.\nDetalhes do erro: ' + error.message);
    }
}

// Inicializa a carga das aulas ao carregar a página
loadCards();

// Atualiza as aulas a cada 15 segundos (fazendo o loop contínuo)
setInterval(loadCards, 15000);
