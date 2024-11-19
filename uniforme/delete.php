<?php
include_once('config.php');

if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Prepara a consulta de exclusão
    $sqlDelete = "DELETE FROM Alunos WHERE id=?";
    $stmtDelete = $conexao->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);

    // Executa a consulta DELETE
    if ($stmtDelete->execute()) {
        echo "Aluno deletado com sucesso!";
    } else {
        echo "Erro ao deletar aluno: " . $stmtDelete->error;
    }

    // Fecha o statement
    $stmtDelete->close();
}

header('Location: listaaluno.php');
exit;
?>
