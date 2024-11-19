<?php
include_once('config.php');

// Verifica se houve um envio de formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação básica (adicione mais validações conforme necessário)
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Verifica se o email já está cadastrado
        $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email); // Assumindo que email é uma string

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                echo "Este email já está cadastrado. Tente outro.";
            } else {
                // Senha com hash (para segurança)
                $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

                // Prepara a consulta SQL para inserir um novo usuário
                $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome, $email, $senhaHash); // 'sss' indica que são três strings

                // Executa a inserção no banco de dados
                if ($stmt->execute()) {
                    echo "Conta criada com sucesso!";
                    // Redireciona para login ou para outra página
                    header("Location: login.php");
                } else {
                    echo "Erro ao criar conta. Tente novamente.";
                }
            }
        } else {
            // Erro na execução da consulta
            echo "Erro ao verificar o email: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - UniForme</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Criar Conta</h1>
    </header>
    <main>
        <div class="container">
            <div class="auth-box">
                <h2>Preencha seus dados</h2>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <button type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
