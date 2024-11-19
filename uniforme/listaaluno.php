<?php
// Inclui o arquivo de configuração (config.php)
include_once('config.php');

// Configura o fuso horário para Brasília
date_default_timezone_set('America/Sao_Paulo');

// Obtém a data e o horário inicial
$dataHoraInicial = date('Y-m-d H:i:s');

// Obtém o termo de busca da URL (se existir)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Cria a consulta SQL com filtragem por nome ou sala
$sql = "SELECT id, nome, sala
        FROM Alunos 
        WHERE id LIKE '%$searchTerm%' 
        OR nome LIKE '%$searchTerm%'
        ORDER BY sala";

// Executa a consulta e verifica se houve sucesso
$result = $conexao->query($sql);
if (!$result) {
    die("Falha ao executar a consulta: " . $conexao->error);
}

// Agrupa os alunos por ano e sala
$alunosPorAno = [];
while ($user_data = mysqli_fetch_assoc($result)) {
    $ano = intval($user_data['sala']); // Assumindo que 'sala' representa o ano
    $alunosPorAno[$ano][] = $user_data;
}

// Frases para cada sala
$frases = [
    1 => "1º Ano",
    2 => "2º Ano",
    3 => "3º Ano"
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Alunos</title>
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
        .box-search {
            display: flex;
            justify-content: center;
            gap: 0.1%;
        }
        .table-bordered {
            margin-bottom: 25px;
        }
        .header-section {
            margin-bottom: 30px;
        }
        .text-center h1, .text-center h4 {
            color: #fff;
        }
        .form-control {
            margin-right: 5px;
            width: 300px;
        }
        .btn-primary, .btn-danger, .btn-warning {
            margin-right: 5px;
        }
        .card {
            margin-bottom: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
        }
        .card-body {
            padding: 15px;
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

    <!-- Header Section -->
    <header class="header-section">
        <h1>Lista de Alunos</h1>
        <h4>Horário Atual (Brasília):</h4>
        <p id="relogio"><?php echo date('d/m/Y H:i:s', strtotime($dataHoraInicial)); ?></p>
    </header>

    <!-- Search Box -->
    <div class="box-search">
        <input type="text" id="pesquisar" placeholder="Pesquisar..." class="form-control" />
        <button onclick="searchData()" class="btn btn-primary">Buscar</button>
    </div>

    <!-- Tabelas de alunos por sala -->
    <div class="container">
        <form action="verificar.php" method="POST">
            <?php
            // Verifica se existem alunos para cada ano e exibe a tabela
            if (!empty($alunosPorAno)) {
                foreach ($alunosPorAno as $ano => $alunos) {
                    echo "<div class='card'>
                            <div class='card-header'>
                                <h5>" . (isset($frases[$ano]) ? $frases[$ano] : "Ano $ano") . "</h5>
                            </div>
                            <div class='card-body'>
                                <table class='table table-bordered table-bg'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Sala</th>
                                            <th>Com Uniforme</th>
                                            <th>Sem Uniforme</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                    // Exibe os alunos do ano atual
                    foreach ($alunos as $aluno) {
                        echo "<tr>
                                <td>{$aluno['id']}</td>
                                <td>{$aluno['nome']}</td>
                                <td>{$frases[$ano]}</td>
                                <td><input type='radio' name='aluno_{$aluno['id']}' value='com' checked></td>
                                <td><input type='radio' name='aluno_{$aluno['id']}' value='sem'></td>
                                <td>
                                    <a href='edit.php?id={$aluno['id']}' class='btn btn-sm btn-warning'>Editar</a>
                                    <a href='delete.php?id={$aluno['id']}' class='btn btn-sm btn-danger'>Excluir</a>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table></div></div>";
                }
            } else {
                echo "<p class='text-center'>Nenhum aluno encontrado.</p>";
            }
            ?>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Verificação</button>
            </div>
        </form>
    </div>

    <script>
        // Função para realizar a pesquisa
        function searchData() {
            const search = document.getElementById('pesquisar').value;
            window.location = `?search=${search}`;
        }

        // Atualiza o horário automaticamente
        function atualizarRelogio() {
            const relogio = document.getElementById('relogio');
            const agora = new Date();
            const formatado = agora.toLocaleString('pt-BR', { timeZone: 'America/Sao_Paulo' });
            relogio.textContent = formatado;
        }
        setInterval(atualizarRelogio, 1000);
    </script>
</body>
</html>
