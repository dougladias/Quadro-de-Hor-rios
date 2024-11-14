<?php

// Pegando os dados vindo do formulário de cadastro
$nome = $_POST['nome'];
$email = $_POST['email'];
$password = $_POST['password'];

// Configurações de credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco =  'formulario_login_increver-se';

// Conexão com o banco de dados
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha ao se comunicar com banco de dados: " . $conn->connect_error);
}

// Preparar a consulta para inserir o novo usuário com status 'pendente'
$smtp = $conn->prepare("INSERT INTO login (nome, email, password, status) VALUES (?, ?, ?, 'pendente')");
$smtp->bind_param("sss", $nome, $email, $password);

if ($smtp->execute()) {
    echo "Cadastro realizado com sucesso! Aguarde aprovação.";

    header("refresh:0; ../pages/index.html"); 
    exit(); 
} else {
    echo "Erro no envio da mensagem: " . $smtp->error;
}

$smtp->close();
$conn->close();

?>

