<?php
// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se';

$conn = new mysqli($server, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar a aula pelo ID
    $sql = "SELECT * FROM aulas_cadastradas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $aula = $result->fetch_assoc();
        echo json_encode($aula);
    } else {
        echo json_encode(['error' => 'Aula não encontrada']);
    }

    $stmt->close();
}

$conn->close();
?>
