<?php
include_once('config.php');

if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['sala'])) {
    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $sala = mysqli_real_escape_string($conexao, $_POST['sala']);

    // Prepara a consulta de atualização
    $sqlUpdate = "UPDATE Alunos SET nome=?, sala=? WHERE id=?";
    $stmtUpdate = $conexao->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssi", $nome, $sala, $id);

    // Executa a consulta
    if ($stmtUpdate->execute()) {
        echo "Aluno atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar aluno: " . $stmtUpdate->error;
    }

    // Fecha o statement
    $stmtUpdate->close();
    header('Location: listaaluno.php');
    exit;
} else {
    echo "Dados incompletos.";
}
?>
