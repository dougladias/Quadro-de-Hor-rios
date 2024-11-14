<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Alteração de Aula</title>
    <link rel="stylesheet" href="../css/requerimento.css">

</head>
<body>
    <div class="container">
        <h1>Solicitação de Alteração de Aula</h1>
        <form id="solicitacao-form">
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome" name="nome" style="text-transform: uppercase;" required>

            <label for="disciplina">Disciplina:</label>
            <input type="text" id="disciplina" name="disciplina" style="text-transform: uppercase;" required>
            
            <label for="tipo">Tipo de Alteração:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecione</option>
                <option value="data">Alteração de Data</option>
                <option value="sala">Alteração de Sala</option>
                <option value="cancelamento">Cancelamento de Aula</option>
                <option value="outro">Outro</option>
            </select>

            <label for="data">Data da Aula:</label>
            <input type="date" id="data" name="data" required>

            <label for="horario-inicio">Horário de Início:</label>
            <input type="time" id="horario-inicio" name="horario-inicio" required>

            <label for="horario-fim">Horário de Fim:</label>
            <input type="time" id="horario-fim" name="horario-fim" required>

            <label for="sala">Digite o Nome da Sala e o Andar:</label>
            <input type="text" id="sala" name="sala" placeholder="Ex: Sala B202 - 1° Andar" style="text-transform: uppercase;" />

            <label for="justificativa">Justificativa:</label>
            <textarea id="justificativa" name="justificativa" rows="4" style="text-transform: uppercase;" required></textarea>

            <button type="submit">Enviar Solicitação</button>
        </form>
    </div>
    
    <script src="../js/requerimento.js"></script>
</body>
</html>
