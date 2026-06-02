<?php
    require_once("conexao.php");
    session_start();

    if (isset($_GET['id']) && isset($_GET['atividade_id'])) {
        $id = $_GET['id'];
        $atividade_id = $_GET['atividade_id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM participacoes WHERE id = ?");
            $stmt->execute([$id]);
        } catch (Exception $e) {
            // Silencioso ou trate o erro
        }

        header("Location: participacoes.php?atividade_id=" . $atividade_id);
        exit();
    }
    header("Location: atividades.php");
    exit();
?>