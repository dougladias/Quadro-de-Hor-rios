document.addEventListener('DOMContentLoaded', () => {
    const aulaCursoSelect = document.getElementById('aula-curso');
    const aulaGradeSelect = document.getElementById('aula-grade');

    // Função para carregar cursos
    function carregarCursos() {
        fetch('../php/listar_curso_aula.php')
            .then(response => response.json())
            .then(data => {
                preencherCursos(data);
            })
            .catch(error => console.error('Erro ao carregar cursos:', error));
    }

    function preencherCursos(cursos) {
        aulaCursoSelect.innerHTML = '<option value="">Selecione um curso</option>';
        cursos.forEach(curso => {
            const option = document.createElement('option');
            option.value = curso.nome.toUpperCase(); 
            option.textContent = curso.nome.toUpperCase(); 
            aulaCursoSelect.appendChild(option);
        });
    }

    // Adiciona listener para quando o curso é selecionado
    aulaCursoSelect.addEventListener('change', (e) => {
        const cursoNome = e.target.value; 
        atualizarAulas(cursoNome);
    });

    function atualizarAulas(cursoNome) {
        if (!cursoNome) {
            aulaGradeSelect.innerHTML = '<option value="">Selecione uma aula</option>';
            return;
        }

        fetch(`../php/listar_curso_aula.php?curso_nome=${cursoNome}`)
            .then(response => response.json())
            .then(aulas => {
                aulaGradeSelect.innerHTML = '<option value="">Selecione uma aula</option>';
                aulas.forEach(aula => {
                    const option = document.createElement('option');
                    option.value = aula.nome.toUpperCase(); 
                    option.textContent = aula.nome.toUpperCase(); 
                    aulaGradeSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar aulas:', error));
    }

    // Carrega os cursos ao iniciar
    carregarCursos();
});
