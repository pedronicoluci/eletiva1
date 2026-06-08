<?php
    require_once("conexao.php");
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM cargos WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: cargos.php");
            exit();
        } catch (Exception $e) {
            echo "<script>
                    alert('Não é possível excluir este cargo porque existem membros associados a ele! Remova ou altere os membros primeiro.');
                    window.location.href='cargos.php';
                  </script>";
            exit();
        }
    }
    header("Location: cargos.php");
    exit();
?>