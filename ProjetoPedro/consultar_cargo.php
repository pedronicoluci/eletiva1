<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if (!isset($_GET['id'])) {
        header("Location: cargos.php");
        exit();
    }
    $id = $_GET['id'];

    // LÓGICA: Busca os dados para exibição
    try {
        $stmt = $pdo->prepare("SELECT * FROM cargos WHERE id = ?");
        $stmt->execute([$id]);
        $cargo = $stmt->fetch();
        if (!$cargo) die("Cargo não encontrado.");
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }

    // LÓGICA: Se clicar no botão (POST), deleta o registro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $stmt = $pdo->prepare("DELETE FROM cargos WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: cargos.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao excluir: " . $e->getMessage() . ". Certifique-se de que nenhum membro está usando este cargo.</div>";
        }
    }
?>

<h1>Consultar Cargo</h1>
<div class="card p-3 mb-3">
    <p><strong>Nome do Cargo:</strong> <?= $cargo['nome'] ?></p>
    <p><strong>Descrição:</strong> <?= $cargo['descricao'] ?></p>
</div>

<form method="post">
    <button type="submit" class="btn btn-danger">Excluir</button>
    <a href="cargos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require_once("rodape.php"); ?>