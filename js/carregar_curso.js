document.addEventListener('DOMContentLoaded', () => {
    const divCursosCadastrados = document.getElementById('cursos-cadastrados');

    function carregarCursos() {
        fetch('../php/carregar_curso_aula.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(cursos => {
                divCursosCadastrados.innerHTML = ''; 
                cursos.forEach(curso => {
                    const divCurso = document.createElement('div');
                    divCurso.style.backgroundColor = 0; 
                    divCurso.style.padding = '10px';
                    divCurso.style.margin = '0px';
                    divCurso.style.borderRadius = '5px';
                    
                    

                    divCurso.innerHTML = `
                        <strong>${curso.nome.toUpperCase()}</strong>
                        <button onclick="editarCurso(${curso.id})">Editar</button>
                        <ul>
                            ${curso.aulas.map(aula => `<li>${aula.toUpperCase()}</li>`).join('')}
                        </ul>
                    `;
                    divCursosCadastrados.appendChild(divCurso);
                });
            })
            .catch(error => console.error('Erro ao carregar cursos:', error));
    }

    window.editarCurso = function(cursoId) {
        location.href = `../pages/cadastro_curso.html?curso_id=${cursoId}`;
    };

    carregarCursos();
});
