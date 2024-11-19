<?php
include_once('config.php');

// Checkar conexão
if ($conexao->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conexao->connect_error);
}

// Receber dados do formulário
if (isset($_POST['nome']) && isset($_POST['sala'])) {
    $nome = $_POST['nome'];
    $sala = $_POST['sala'];

    // Inserção no banco de dados
    $sql = "INSERT INTO Alunos (nome, sala) VALUES ('$nome', '$sala')";

    if ($conexao->query($sql) === TRUE) {
        // Redireciona para uniforme61.php com mensagem de sucesso
        header("Location: uniforme61.php?success=1");
        exit; // Finaliza o script após redirecionar
    } else {
        echo "Erro ao cadastrar o usuário: " . $conexao->error;
    }
} else {
    echo "Erro: Dados do formulário não enviados corretamente.";
}

$conexao->close(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno - UniForme</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Cadastrar Aluno</h1>
    </header>
    <main>
        <div class="container">
            <div class="auth-box">
                <h2>Preencha os dados do aluno</h2>
                <form action="uniforme6.php" method="post">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="sala">Sala:</label>
                        <input type="text" id="sala" name="sala" required>
                    </div>
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
