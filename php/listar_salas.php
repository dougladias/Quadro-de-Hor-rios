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

// Consulta para obter as salas cadastradas
$sql = "SELECT nome, capacidade, andar FROM salas";
$result = $conn->query($sql);

// Criar um array para armazenar as salas
$salas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $salas[] = ['nome' => $row['nome'], 'capacidade' => $row['capacidade'], 'andar' => $row['andar']];
    }
} else {
    $salas = []; 
}

$conn->close(); 

// Retornar as salas em formato JSON
echo json_encode($salas);
?>

