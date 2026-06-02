<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    try {
        // Buscamos os membros juntando com a tabela de cargos para exibir o nome do cargo
        $query = "SELECT membros.id, membros.nome, membros.email, cargos.nome AS nome_cargo 
                  FROM membros 
                  INNER JOIN cargos ON membros.cargo_id = cargos.id";
        $stmt = $pdo->query($query);
        $membros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Erro ao buscar membros: " . $e->getMessage() . "</div>";
        $membros = [];
    }
?>

<h2>Membros da Associação</h2>
<a href="novo_membro.php" class="btn btn-success mb-3">Novo Membro</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Cargo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($membros) > 0): ?>
            <?php foreach ($membros as $membro): ?>
                <tr>
                    <td><?= $membro['id'] ?></td>
                    <td><?= $membro['nome'] ?></td>
                    <td><?= $membro['email'] ?></td>
                    <td><span class="badge bg-primary"><?= $membro['nome_cargo'] ?></span></td>
                    <td>
                        <a href="alterar_membro.php?id=<?= $membro['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="consultar_membro.php?id=<?= $membro['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Nenhum membro cadastrado ainda.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>