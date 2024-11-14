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

// Adicionar aula
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturando os dados do formulário
    $curso = $_POST['aula-curso'];           
    $corCurso = $_POST['curso-cor'];         
    $grade = $_POST['aula-grade'];           
    $periodo = $_POST['aula-periodo'];       
    $salaCompleta = $_POST['aula-sala'];     
    $professorNome = $_POST['aula-professor']; 
    $publico = $_POST['aula-publico'];       
    $modalidade = $_POST['aula-modalidade']; 
    $horarioInicio = $_POST['aula-horario-inicio']; 
    $horarioFim = $_POST['aula-horario-fim']; 
    $diaSemana = $_POST['dia-semana'];       
    
   

    // Extraindo o nome da sala e o andar do campo "salaCompleta"
    list($salaNome, $salaAndar, $salaCapacidade) = explode(" - ", $salaCompleta);
    $salaAndar = (int) $salaAndar;    
    $salaCapacidade = (int) $salaCapacidade; 

    // Preparar a consulta para inserir cadastro de aulas
    $stmt = $conn->prepare("INSERT INTO aulas_cadastradas 
        (curso_nome, curso_cor, aula_nome, aula_periodo, sala_nome, sala_andar, sala_capacidade, professor_nome, publico, modalidade, horario_inicio, horario_fim, dia_semana) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Vincular os parâmetros
    $stmt->bind_param("sssssiissssss", $curso, $corCurso, $grade, $periodo, $salaNome, $salaAndar, $salaCapacidade, $professorNome, $publico, $modalidade, $horarioInicio, $horarioFim, $diaSemana);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "Aula cadastrada com sucesso!";
        header("refresh:0; url=../pages/cadastro_aula.html"); 
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close(); 
}

$conn->close(); 
?>
