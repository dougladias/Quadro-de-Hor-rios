<?php

// Pegando os dados vindo do formulário de cadastro
$nome = $_POST['sala-nome'];
$capacidade = $_POST['sala-capacidade'];
$andar = $_POST['sala-andar'];

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

// Preparar a consulta para inserir cadastro de salas
$smtp = $conn->prepare("INSERT INTO salas (nome, capacidade, andar) VALUES (?, ?, ?)");
$smtp->bind_param("sss", $nome, $capacidade, $andar); 

// Executar a consulta
if ($smtp->execute()) {
    echo "Sala cadastrada com sucesso!";

    header("refresh:0; url=../pages/cadastro_sala.html"); 
    exit(); 

} else {
    echo "Erro ao cadastrar sala: " . $smtp->error;
}

// Fechar a consulta e a conexão
$smtp->close();
$conn->close();

?>
