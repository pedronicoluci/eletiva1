<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if (!isset($_GET['id'])) {
        header("Location: cargos.php");
        exit();
    }
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM cargos WHERE id = ?");
        $stmt->execute([$id]);
        $cargo = $stmt->fetch();
        if (!$cargo) die("Cargo não encontrado.");
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }
?>

<h1>Consultar Patente</h1>
<div class="card p-3 mb-3">
    <p><strong>Nome da Patente:</strong> <?= $cargo['nome'] ?></p>
    <p><strong>Descrição:</strong> <?= $cargo['descricao'] ?></p>
</div>

<div class="mb-3">
    <a href="cargos.php" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once("rodape.php"); ?>