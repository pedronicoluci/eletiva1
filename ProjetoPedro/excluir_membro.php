<?php
    require_once("conexao.php");
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM membros WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: membros.php");
            exit();
        } catch (Exception $e) {
            echo "<script>
                    alert('Erro ao excluir membro: " . addslashes($e->getMessage()) . "');
                    window.location.href='membros.php';
                  </script>";
            exit();
        }
    }
    header("Location: membros.php");
    exit();
?>