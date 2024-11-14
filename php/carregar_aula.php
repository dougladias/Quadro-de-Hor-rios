<?php
// Conexão com o banco de dados
$servername = 'localhost';
$username = 'root';
$password = ''; 
$dbname = 'formulario_login_increver-se'; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Listar aulas com o nome do professor
$sql = "SELECT a.*, p.nome AS professor_nome 
        FROM aulas_cadastradas a 
        JOIN professores p ON a.professor_id = p.id 
        ORDER BY a.dia_semana ASC, a.horario_inicio ASC";
$result = $conn->query($sql);
$aulas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $aulas[] = $row;
    }
}

$conn->close();
echo json_encode($aulas);
?>

