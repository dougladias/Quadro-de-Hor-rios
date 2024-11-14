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

// Buscar todos os cursos com suas respectivas aulas e cores
$sql = "SELECT cursos.id AS curso_id, cursos.nome AS curso_nome, cursos.cor AS curso_cor, aulas.nome AS aula_nome 
        FROM cursos 
        LEFT JOIN aulas ON cursos.id = aulas.curso_id";
$result = $conn->query($sql);

$cursos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cursoId = $row['curso_id'];
        if (!isset($cursos[$cursoId])) {
            $cursos[$cursoId] = [
                'id' => $cursoId,
                'nome' => $row['curso_nome'],
                'cor' => $row['curso_cor'],
                'aulas' => []
            ];
        }
        if ($row['aula_nome']) {
            $cursos[$cursoId]['aulas'][] = $row['aula_nome']; 
        }
    }
}

// Retornar os cursos e suas aulas em formato JSON
header('Content-Type: application/json');
echo json_encode(array_values($cursos));

$conn->close();
?>
