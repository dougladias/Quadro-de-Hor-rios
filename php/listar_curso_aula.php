<?php

// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se'; 

// Criar conexão
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se foi enviado um nome de curso
if (isset($_GET['curso_nome'])) {
    $curso_nome = $conn->real_escape_string($_GET['curso_nome']);
    $sql = "SELECT nome FROM aulas WHERE curso_id = (SELECT id FROM cursos WHERE nome = '$curso_nome')";
    $result = $conn->query($sql);
    
    // Criar um array para armazenar as aulas
    $aulas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aulas[] = ['nome' => $row['nome']]; 
        }
    }

    echo json_encode($aulas);
} else {
    // Se não foi enviado um nome de curso, retorna todos os cursos
    $sql = "SELECT nome FROM cursos";
    $result = $conn->query($sql);
    
    // Criar um array para armazenar os cursos
    $cursos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cursos[] = ['nome' => $row['nome']]; 
        }
    }

    echo json_encode($cursos);
}

$conn->close(); // Fechar conexão
?>
