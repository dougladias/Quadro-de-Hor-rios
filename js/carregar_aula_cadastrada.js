// Função para carregar as aulas cadastradas
function carregarAulas() {
    fetch('../php/carregar_aula_cadastrada.php')
        .then(response => response.json())
        .then(aulas => {
            const aulasContainer = document.getElementById('aulas-container');
            aulasContainer.innerHTML = ''; 

            aulas.forEach(aula => {
                // Verifica se a aula já passou e deve ser excluída (somente após as 00:00)
                if (isAulaPassada(aula)) {
                    return; 
                }

                const aulaRow = document.createElement('div');
                aulaRow.classList.add('aula-row');
                aulaRow.innerHTML = `
                    <span>${aula.publico.toUpperCase()}</span>
                    <span>${aula.curso_nome.toUpperCase()}</span>
                    <span>${aula.modalidade.toUpperCase()}</span>                    
                    <span>${aula.aula_nome.toUpperCase()}</span>                                       
                    <span>${aula.sala_nome.toUpperCase()} - ${aula.sala_andar}°</span>                    
                    <span>${aula.professor_nome.toUpperCase()}</span>                                        
                    <span>${aula.horario_inicio}</span>
                    <span>${aula.dia_semana}</span>
                    <button onclick="editarAula(${aula.id})">Editar</button>
                `;
                aulasContainer.appendChild(aulaRow);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar as aulas:', error);
        });
}

function isAulaPassada(aula) {
    // Definindo a diferença de fuso horário para o fuso horário de São Paulo (UTC-3)
    const fusoHorarioSP = -3 * 60; // São Paulo é UTC-3, então -3 horas em minutos
    
    // Obtém a data e hora atual no fuso horário UTC
    const agoraUTC = new Date();
    
    // Converte para o horário de São Paulo (subtraindo 3 horas)
    const agora = new Date(agoraUTC.getTime() + fusoHorarioSP * 60 * 1000);
    
    // Pegando a hora e minuto da aula (início e fim)
    const [horaInicio, minutoInicio] = aula.horario_inicio.split(':').map(Number);
    const [horaFim, minutoFim] = aula.horario_fim.split(':').map(Number);

    // Criar um objeto Date para a data atual, mas no fuso horário de São Paulo
    const dataAtual = new Date(agora.getFullYear(), agora.getMonth(), agora.getDate());
    const meiaNoite = new Date(dataAtual.setHours(0, 0, 0, 0)); // Definir o momento da meia-noite

    // Criar objetos Date para o início e fim da aula com base no fuso horário de São Paulo
    const aulaDataInicio = new Date(agora.getFullYear(), agora.getMonth(), agora.getDate(), horaInicio, minutoInicio);
    const aulaDataFim = new Date(agora.getFullYear(), agora.getMonth(), agora.getDate(), horaFim, minutoFim);

    // Excluir aula se a aula já passou
    if (aulaDataFim < agora) {
        return true; 
    }

    return false; 
}



// Função para editar uma aula
function editarAula(id) {
    fetch(`../php/editar_aula.php?id=${id}`)
        .then(response => response.json())
        .then(aula => {
            document.getElementById('aula-id').value = aula.id;
            document.getElementById('aula-curso').value = aula.curso_nome;
            document.getElementById('curso-cor').value = aula.curso_cor;
            document.getElementById('aula-grade').value = aula.aula_nome;
            document.getElementById('aula-periodo').value = aula.aula_periodo;
            document.getElementById('aula-professor').value = aula.professor_nome;
            document.getElementById('aula-publico').value = aula.publico;
            document.getElementById('aula-modalidade').value = aula.modalidade;
            document.getElementById('aula-horario-inicio').value = aula.horario_inicio;
            document.getElementById('aula-horario-fim').value = aula.horario_fim;
            document.getElementById('dia-semana').value = aula.dia_semana;
        })
        .catch(error => console.error('Erro ao carregar dados da aula para edição:', error));
}

// Função de busca de aulas
function buscarAulas() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const aulas = document.querySelectorAll('.aula-row');
    aulas.forEach(aula => {
        const text = aula.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            aula.style.display = '';
        } else {
            aula.style.display = 'none';
        }
    });
}

// Carregar as aulas ao carregar a página
document.addEventListener('DOMContentLoaded', carregarAulas);
