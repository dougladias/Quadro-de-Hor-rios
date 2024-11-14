// Função para carregar as cores dos cursos
function carregarCoresCursos() {
    fetch('../php/listar_cor_curso.php')  
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar cursos');
            }
            return response.json();
        })
        .then(cursos => {
            const cursoCorSelect = document.getElementById('curso-cor');  
            // Limpar as opções existentes no select
            cursoCorSelect.innerHTML = '<option value="">Selecione uma Cor</option>';
            
            // Adiciona as opções ao select
            cursos.forEach(curso => {
                const option = document.createElement('option');
                option.value = curso.cor;  
                option.textContent = `${curso.nome.toUpperCase()} - ${curso.cor.toUpperCase()}`;  
                option.style.backgroundColor = curso.cor;  
                cursoCorSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao carregar as cores dos cursos:', error));
}

// Chama a função ao carregar a página
document.addEventListener('DOMContentLoaded', carregarCoresCursos);
