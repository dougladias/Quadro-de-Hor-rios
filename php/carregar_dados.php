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

// Verificar se o parâmetro 'curso_id' foi enviado
if (isset($_GET['curso_id'])) {
    $curso_id = (int)$_GET['curso_id'];

    // Buscar aulas com base no ID do curso
    $sql = "SELECT id, nome FROM aulas WHERE curso_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $aulas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aulas[] = $row; 
        }
    }

    // Retornar as aulas em formato JSON
    header('Content-Type: application/json');
    echo json_encode($aulas);
    
} else {
    // Buscar cursos se 'curso_id' não estiver definido
    $sql = "SELECT id, nome FROM cursos";
    $result = $conn->query($sql);

    $cursos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cursos[] = $row; 
        }
    }

    // Retornar os cursos em formato JSON
    header('Content-Type: application/json');
    echo json_encode($cursos);
}

// Fechar a conexão
$conn->close();
?>
