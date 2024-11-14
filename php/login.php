<?php

// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se'; 

$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Depuração: verifique o que está sendo enviado
    var_dump($_POST); 

    // Verifica se as chaves estão definidas
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Consulta para verificar o usuário e o status
        $stmt = $conn->prepare("SELECT * FROM login WHERE email = ? AND password = ? AND status = 'ativo'");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado
        if ($result->num_rows > 0) {
            // Login bem-sucedido
            echo "Login realizado com sucesso!";
            // Redireciona após 2 segundos
            header("refresh:0; url=../pages/cadastro_curso.html"); 
            exit(); 
        } else {
            // Login falhou
            echo "Email ou senha incorretos ou sua conta está pendente.";
        }

        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>


