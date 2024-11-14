<?php
// Configura o fuso horário para São Paulo (UTC-3)
date_default_timezone_set('America/Sao_Paulo');

// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se';

// Criar conexão
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar todas as aulas cadastradas
$sql = "SELECT * FROM aulas_cadastradas";
$result = $conn->query($sql);

// Verificar se há registros
$aulas = [];
if ($result->num_rows > 0) {
    // Loop para pegar todos os dados e colocar em um array
    while ($row = $result->fetch_assoc()) {
        // Convertendo os horários para o formato UTC-3 de São Paulo
        $horario_inicio = new DateTime($row['horario_inicio'], new DateTimeZone('UTC'));
        $horario_inicio->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        
        $horario_fim = new DateTime($row['horario_fim'], new DateTimeZone('UTC'));
        $horario_fim->setTimezone(new DateTimeZone('America/Sao_Paulo'));

        $aulas[] = [
            'id' => $row['id'],
            'curso_nome' => $row['curso_nome'],
            'curso_cor' => $row['curso_cor'],
            'aula_nome' => $row['aula_nome'],
            'aula_periodo' => $row['aula_periodo'],
            'sala_nome' => $row['sala_nome'],
            'sala_andar' => $row['sala_andar'],
            'sala_capacidade' => $row['sala_capacidade'],
            'professor_nome' => $row['professor_nome'],
            'publico' => $row['publico'],
            'modalidade' => $row['modalidade'],
            'horario_inicio' => $horario_inicio->format('H:i'), 
            'horario_fim' => $horario_fim->format('H:i'), 
            'dia_semana' => $row['dia_semana']
        ];
    }
}

// Definir o cabeçalho como JSON
header('Content-Type: application/json');

// Retornar os dados como JSON
echo json_encode($aulas);

$conn->close(); 
?>
