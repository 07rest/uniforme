<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Concluído - UniForme</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Cadastro Concluído</h1>
    </header>
    <main>
        <div class="container">
            <div class="message-box">
                <?php
                // Verifica se a mensagem de sucesso foi passada na URL
                if (isset($_GET['success']) && $_GET['success'] == 1) {
                    echo "<h2>O aluno foi cadastrado com sucesso! Obrigado.</h2>";
                }
                ?>
                <a href="uniforme6.php" class="btn">Cadastrar outro Aluno</a>
            </br> <a href="uniforme1.php" class="btn">Voltar para a Página Principal</a>
            </div>
        </div>
    </main>
</body>
</html>
