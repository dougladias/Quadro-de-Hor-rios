<?php
// Conexão com o banco de dados (ajuste conforme necessário)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'formulario_login_increver-se';  

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para obter os cursos e suas cores
$sql = "SELECT id, nome, cor FROM cursos";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Cria um array para armazenar os dados dos cursos
    $cursos = array();
    
    while($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }
    
    // Retorna os dados em formato JSON
    echo json_encode($cursos);
} else {
    echo json_encode([]); 
}

// Fecha a conexão com o banco
$conn->close();
?>
