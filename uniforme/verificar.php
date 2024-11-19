<?php
// Inclui o arquivo de configuração (config.php)
include_once('config.php');

// Inicializa um array para armazenar os alunos sem uniforme agrupados por turma
$alunosSemUniformePorTurma = [];

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Itera por todos os alunos enviados
    foreach ($_POST as $key => $value) {
        // Verifica se o nome do campo contém "aluno_" (nome do aluno)
        if (strpos($key, 'aluno_') === 0) {
            // Obtém o ID do aluno (remover "aluno_" do nome do campo)
            $alunoId = str_replace('aluno_', '', $key);
            
            // Se o valor for "sem", adiciona o aluno à lista de alunos sem uniforme
            if ($value === 'sem') {
                // Consulta para obter os dados do aluno
                $sql = "SELECT id, nome, sala FROM Alunos WHERE id = $alunoId";
                $result = $conexao->query($sql);
                if ($result && $result->num_rows > 0) {
                    $aluno = $result->fetch_assoc();
                    // Adiciona o aluno ao array de alunos sem uniforme, agrupando por sala
                    $alunosSemUniformePorTurma[$aluno['sala']][] = $aluno;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Uniformes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ADD8E6; /* Azul Claro */
            color: black;
            text-align: center;
        }
        .table-bg {
            background-color: #191970;
            color: white;
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema de Uniformes</a>
            <div class="d-flex">
                <a href="sair.php" class="btn btn-danger me-5">Sair</a>
            </div>
        </div>
    </nav>

    <h1>Verificação dos Alunos Sem Uniforme</h1>

    <!-- Exibição da Tabela de Alunos Sem Uniforme -->
    <?php if (!empty($alunosSemUniformePorTurma)): ?>
        <?php foreach ($alunosSemUniformePorTurma as $sala => $alunos): ?>
            <h3>Turma: <?php echo $sala; ?></h3>
            <table class="table table-bordered table-bg">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sala</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?php echo $aluno['id']; ?></td>
                            <td><?php echo $aluno['nome']; ?></td>
                            <td><?php echo $aluno['sala']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum aluno marcado como "sem uniforme" foi encontrado.</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="listaaluno.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
