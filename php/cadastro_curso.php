<?php
// Pegando os dados do formulário de cadastro
$nomeCurso = isset($_POST['curso-nome']) ? trim($_POST['curso-nome']) : null;
$cursoCor = isset($_POST['curso-cor']) ? trim($_POST['curso-cor']) : null;
$aulas = isset($_POST['aula']) ? $_POST['aula'] : []; 

// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se';

$conn = new mysqli($server, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o nome do curso e a cor não são nulos
if (empty($nomeCurso) || empty($cursoCor)) {
    die("Erro: O nome do curso e a cor não podem estar vazios.");
}

// Preparar a consulta para inserir o curso
$stmtCurso = $conn->prepare("INSERT INTO cursos (nome, cor) VALUES (?, ?)");
$stmtCurso->bind_param("ss", $nomeCurso, $cursoCor);

// Executar a consulta do curso
if ($stmtCurso->execute()) {
    $cursoId = $stmtCurso->insert_id; 

    // Preparar a consulta para inserir aulas
    $stmtAula = $conn->prepare("INSERT INTO aulas (curso_id, nome) VALUES (?, ?)");

    // Inserir cada aula
    foreach ($aulas as $nomeAula) {
        if (!empty($nomeAula)) { 
            $stmtAula->bind_param("is", $cursoId, $nomeAula);
            if (!$stmtAula->execute()) {
                echo "Erro ao cadastrar aula: " . $stmtAula->error;
            }
        }
    }

    echo "Curso e aulas cadastrados com sucesso!";
    header("refresh:0; url=../pages/cadastro_curso.html");
    exit();
    
} else {
    echo "Erro ao cadastrar curso: " . $stmtCurso->error;
}

// Fechar a consulta e a conexão
$stmtAula->close();
$stmtCurso->close();
$conn->close();
?>
