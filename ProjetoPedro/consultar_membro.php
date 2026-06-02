<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if (!isset($_GET['id'])) {
        header("Location: membros.php");
        exit();
    }
    $id = $_GET['id'];

    try {
        $query = "SELECT membros.nome, membros.email, cargos.nome AS nome_cargo 
                  FROM membros 
                  INNER JOIN cargos ON membros.cargo_id = cargos.id 
                  WHERE membros.id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $membro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$membro) { die("Membro não encontrado!"); }
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $stmt = $pdo->prepare("DELETE FROM membros WHERE id = ?");
            $stmt->execute([$id]);

            header("Location: membros.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao excluir membro: " . $e->getMessage() . "</div>";
        }
    }
?>

<h1>Consultar Membro</h1>
<form method="post">
    <div class="mb-3 card p-3 bg-light">
        <p><strong>Nome Completo:</strong> <?= $membro['nome'] ?></p>
        <p><strong>E-mail de Contato:</strong> <?= $membro['email'] ?></p>
        <p><strong>Cargo Atribuído:</strong> <span class="badge bg-primary"><?= $membro['nome_cargo'] ?></span></p>
    </div>
    <button type="submit" class="btn btn-danger">Remover Membro</button>
    <a href="membros.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>