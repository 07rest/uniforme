<?php
include_once('config.php');

// Verifica se o parâmetro 'id' foi enviado via GET
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Prepara a consulta para buscar o aluno pelo id
    $sql = "SELECT * FROM Alunos WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $nome = $user_data['nome'];
            $sala = $user_data['sala'];
        } else {
            echo "Aluno não encontrado.";
            exit;
        }
    } else {
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }

    $stmt->close();
} else {
    header('Location: listaaluno.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>Editar Aluno</h1>
</br> </br><a href="listaaluno.php">Voltar</a>
    <form action="saveEdit.php" method="POST">
        <fieldset>
            <label for="nome">Nome:</label>
            <!-- htmlspecialchars para garantir exibição correta -->
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

            <label for="sala">Sala:</label>
            <input type="text" id="sala" name="sala" value="<?php echo htmlspecialchars($sala); ?>" required>

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <input type="submit" value="Salvar Alterações">
        </fieldset>
    </form>
</body>
</html>
