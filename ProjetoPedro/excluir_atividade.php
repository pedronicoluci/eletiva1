<?php
    require_once("conexao.php");
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM atividades WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: atividades.php");
            exit();
        } catch (Exception $e) {
            echo "<script>
                    alert('Não é possível excluir uma atividade que já possui membros na lista de presença! Remova os participantes primeiro.');
                    window.location.href='atividades.php';
                  </script>";
            exit();
        }
    }
    header("Location: atividades.php");
    exit();
?>