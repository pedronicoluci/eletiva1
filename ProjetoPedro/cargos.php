<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    // LÓGICA: Busca todos os cargos cadastrados
    try {
        $stmt = $pdo->query("SELECT * FROM cargos");
        $cargos = $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao buscar cargos: " . $e->getMessage());
    }
?>

<h2>Cargos da Associação</h2>
<a href="novo_cargo.php" class="btn btn-success mb-3">Novo Registro</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cargos as $cargo): ?>
            <tr>
                <td><?= $cargo['id'] ?></td>
                <td><?= $cargo['nome'] ?></td>
                <td><?= $cargo['descricao'] ?></td>
                <td class="d-flex gap-2">
                    <a href="alterar_cargo.php?id=<?= $cargo['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="consultar_cargo.php?id=<?= $cargo['id'] ?>" class="btn btn-sm btn-info">Consultar/Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once("rodape.php"); ?>