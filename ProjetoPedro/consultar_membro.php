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
?>

<h1>Consultar Membro</h1>
<div class="mb-3 card p-3 bg-light">
    <p><strong>Nome Completo:</strong> <?= $membro['nome'] ?></p>
    <p><strong>E-mail de Contato:</strong> <?= $membro['email'] ?></p>
    <p><strong>Cargo Atribuído:</strong> <span class="badge bg-primary"><?= $membro['nome_cargo'] ?></span></p>
</div>

<div class="mb-3">
    <a href="membros.php" class="btn btn-secondary">Voltar</a>
</div>

<?php
    require_once("rodape.php");
?>