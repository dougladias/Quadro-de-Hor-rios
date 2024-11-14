<?php
// Conexão com o banco de dados
$server = 'localhost';
$usuario = 'root';
$senha = ''; 
$banco = 'formulario_login_increver-se';

// Criar conexão
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    // Retornar erro como JSON
    echo json_encode(["success" => false, "message" => "Conexão falhou: " . $conn->connect_error]);
    exit();
}

// Recebendo os dados via POST (do formulário)
$curso = isset($_POST['aula-curso']) ? $_POST['aula-curso'] : null;
$corCurso = isset($_POST['curso-cor']) ? $_POST['curso-cor'] : null;
$grade = isset($_POST['aula-grade']) ? $_POST['aula-grade'] : null;
$periodo = isset($_POST['aula-periodo']) ? $_POST['aula-periodo'] : null;
$sala = isset($_POST['aula-sala']) ? $_POST['aula-sala'] : null;
$professorNome = isset($_POST['aula-professor']) ? $_POST['aula-professor'] : null;
$horarioInicio = isset($_POST['aula-horario-inicio']) ? $_POST['aula-horario-inicio'] : null;
$horarioFim = isset($_POST['aula-horario-fim']) ? $_POST['aula-horario-fim'] : null;
$diaSemana = isset($_POST['dia-semana']) ? $_POST['dia-semana'] : null;
$publico = isset($_POST['aula-publico']) ? $_POST['aula-publico'] : null;
$modalidade = isset($_POST['aula-modalidade']) ? $_POST['aula-modalidade'] : null;
$id = isset($_POST['aula-id']) ? $_POST['aula-id'] : null;  

// Verificar se todos os campos necessários foram enviados
if (!$id || !$curso || !$corCurso || !$grade || !$periodo || !$sala || !$professorNome || !$horarioInicio || !$horarioFim || !$diaSemana || !$publico || !$modalidade) {
    echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios"]);
    exit();
}

// Separando os dados de sala (ex: "Lab 101 - 2° Andar - 30")
$salaPartes = explode(' - ', $sala);

// Verificando se a separação foi feita corretamente
if (count($salaPartes) === 3) {
    $salaNome = $salaPartes[0];         
    $salaAndar = $salaPartes[1];        
    $salaCapacidade = $salaPartes[2];   
} else {
    echo json_encode(["success" => false, "message" => "Dados da sala estão incorretos"]);
    exit();
}

// Preparando a query para atualizar a aula no banco de dados
$stmt = $conn->prepare("UPDATE aulas_cadastradas 
    SET curso_nome = ?, curso_cor = ?, aula_nome = ?, aula_periodo = ?, sala_nome = ?, sala_andar = ?, sala_capacidade = ?, professor_nome = ?, horario_inicio = ?, horario_fim = ?, dia_semana = ?, publico = ?, modalidade = ? 
    WHERE id = ?");

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Erro na preparação da query: " . $conn->error]);
    exit();
}

// Vinculando os parâmetros ao prepared statement
$stmt->bind_param("sssssssssssssi", 
    $curso, $corCurso, $grade, $periodo, $salaNome, $salaAndar, $salaCapacidade, 
    $professorNome, $horarioInicio, $horarioFim, $diaSemana, $publico, $modalidade, $id);

// Executar a consulta
if ($stmt->execute()) {
    echo "Aula cadastrada com sucesso!";
    header("refresh:0; url=../pages/aula_cadastrada.html"); 
    exit();
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
?>
