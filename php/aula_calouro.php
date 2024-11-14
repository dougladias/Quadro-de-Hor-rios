<?php
// Definir o fuso horário para garantir que a hora seja correta
date_default_timezone_set('America/Campo_Grande');  

// Exibe todos os erros para facilitar a depuração durante o desenvolvimento
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Cabeçalho para garantir que a resposta seja no formato JSON
header('Content-Type: application/json');

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

// Hora atual do servidor (hora completa - data e hora)
$currentDateTime = date('Y-m-d H:i:s');  
$currentDate = date('Y-m-d');  
$currentHour = date('H');  

// Inicializar variável de resposta
$response = [
    'hora_atual' => $currentHour,  
    'data_atual' => $currentDateTime,  
];

// Definir os intervalos de horário válidos para as aulas
$intervalos_validos_manha = ['inicio' => '06:00:00', 'fim' => '12:00:00'];
$intervalos_validos_tarde = ['inicio' => '17:00:00', 'fim' => '23:00:00'];

// Inicializar o array de aulas
$aulas = [];

// Verificar o horário atual para decidir qual intervalo de aulas buscar
if ($currentHour >= 6 && $currentHour < 12) {
    // Aulas da manhã (06:00 - 12:00)
    $sql = "
    SELECT 
        id, curso_nome, curso_cor, aula_nome, aula_periodo, sala_nome, sala_andar, 
        professor_nome, publico, modalidade, horario_inicio, horario_fim, dia_semana
    FROM aulas_cadastradas
    WHERE
        DATE(dia_semana) = CURDATE() AND 
        horario_inicio >= '{$intervalos_validos_manha['inicio']}' AND 
        horario_inicio < '{$intervalos_validos_manha['fim']}' AND
        (publico = 'CALOUROS-E-VETERANOS' OR publico = 'CALOUROS')
    ORDER BY horario_inicio;
    ";

    // Executar a consulta de aulas da manhã
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aulas[] = $row;
        }
    }

} else if ($currentHour >= 17 && $currentHour < 23) {
    // Aulas da tarde (17:00 - 23:00)
    $sql = "
    SELECT 
        id, curso_nome, curso_cor, aula_nome, aula_periodo, sala_nome, sala_andar, 
        professor_nome, publico, modalidade, horario_inicio, horario_fim, dia_semana
    FROM aulas_cadastradas
    WHERE
        DATE(dia_semana) = CURDATE() AND 
        horario_inicio >= '{$intervalos_validos_tarde['inicio']}' AND 
        horario_inicio < '{$intervalos_validos_tarde['fim']}' AND
        (publico = 'CALOUROS-E-VETERANOS' OR publico = 'CALOUROS')
    ORDER BY horario_inicio;
    ";

    // Executar a consulta de aulas da tarde
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aulas[] = $row;
        }
    }
}

// Preparar a resposta final
if (empty($aulas)) {
    $response['message'] = 'Nenhuma aula disponível no momento.';
} else {
    $response['aulas'] = $aulas;  
}

// Fechar a conexão com o banco
$conn->close();

// Retornar os dados como JSON
echo json_encode($response);
?>
