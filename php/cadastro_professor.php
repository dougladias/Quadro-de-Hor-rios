<?php
// Conexão com o banco de dados
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'formulario_login_increver-se';

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Adicionar professor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['professor-nome'])) {
    $nome = $conn->real_escape_string($_POST['professor-nome']); 
    $sql = "INSERT INTO professores (nome) VALUES ('$nome')";

    if ($conn->query($sql) === TRUE) {
        // Retorna a lista atualizada de professores em JSON após a inserção
        $professores = [];

        // Listar professores para o JSON
        $sql = "SELECT id, nome FROM professores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $professores[] = $row;
            }
        }

        // Retornar lista de professores em JSON
        header('Content-Type: application/json');
        echo json_encode($professores);
        exit(); 
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Para listar professores com GET, se necessário
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, nome FROM professores";
    $result = $conn->query($sql);
    $professores = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $professores[] = $row;
        }
    }

    // Retornar lista de professores em JSON
    header('Content-Type: application/json');
    echo json_encode($professores);
    exit(); 
}

$conn->close();
?>
