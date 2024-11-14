let aulas = [];
let enviando = false; 

function adicionarAula() {
    const nomeAula = document.getElementById('aula-nome-grade').value;
    if (nomeAula) {
        aulas.push(nomeAula);
        atualizarListaAulas();
        document.getElementById('aula-nome-grade').value = ''; 
    }
}

function atualizarListaAulas() {
    const listaAulas = document.getElementById('aulas-grade');
    listaAulas.innerHTML = ''; 

    aulas.forEach((aula, index) => {
        const li = document.createElement('li');
        li.textContent = aula;

        // Botão de excluir
        const btnExcluir = document.createElement('button');
        btnExcluir.textContent = 'Excluir';
        btnExcluir.onclick = () => excluirAula(index);
        li.appendChild(btnExcluir);

        listaAulas.appendChild(li);
    });
}

function excluirAula(index) {
    aulas.splice(index, 1); 
    atualizarListaAulas(); 
}

function cadastrarCurso() {
    if (enviando) return; 
    enviando = true; 

    const nomeCurso = document.getElementById('curso-nome').value;
    const corCurso = document.getElementById('curso-cor').value;

    if (nomeCurso && aulas.length > 0) {
        console.log('Cadastrando Curso:', nomeCurso, 'Cor:', corCurso, 'Aulas:', aulas);

        const formData = new FormData();
        formData.append('curso-nome', nomeCurso);
        formData.append('curso-cor', corCurso);
        aulas.forEach(aula => formData.append('aula[]', aula));

        fetch('../php/cadastro_curso.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Limpar o formulário após cadastrar
            document.getElementById('curso-nome').value = '';
            document.getElementById('curso-cor').value = '#FFFFFF'; 
            aulas = []; 
            atualizarListaAulas(); 
            enviando = false; 
        })
        .catch(error => {
            console.error('Erro:', error);
            enviando = false; 
        });
    } else {
        alert('Preencha o nome do curso e adicione pelo menos uma aula.');
        enviando = false; 
    }
}


