<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if (!isset($_GET['atividade_id'])) {
        header("Location: atividades.php");
        exit();
    }
    $atividade_id = $_GET['atividade_id'];

    // 1. Busca os detalhes da atividade atual
    $stmtAtiv = $pdo->prepare("SELECT * FROM atividades WHERE id = ?");
    $stmtAtiv->execute([$atividade_id]);
    $atividade = $stmtAtiv->fetch(PDO::FETCH_ASSOC);
    if (!$atividade) { die("Atividade não encontrada!"); }

    // LÓGICA: Vincula um novo participante à atividade
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adicionar_membro'])) {
        $membro_id = $_POST['membro_id'];
        try {
            $stmt = $pdo->prepare("INSERT INTO participacoes (atividade_id, membro_id) VALUES (?, ?)");
            $stmt->execute([$atividade_id, $membro_id]);
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Membro já inserido ou erro no registro!</div>";
        }
    }

    // 2. Busca todos os membros para preencher o <select>
    $membrosDisponiveis = $pdo->query("SELECT id, nome FROM membros ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);

    // 3. Busca quem já teve a presença confirmada nesta atividade específica (INNER JOIN triplo)
    $queryPresenca = "SELECT participacoes.id AS part_id, membros.nome, membros.email, cargos.nome AS cargo 
                      FROM participacoes
                      INNER JOIN membros ON participacoes.membro_id = membros.id
                      INNER JOIN cargos ON membros.cargo_id = cargos.id
                      WHERE participacoes.atividade_id = ?";
    $stmtPresenca = $pdo->prepare($queryPresenca);
    $stmtPresenca->execute([$atividade_id]);
    $participantes = $stmtPresenca->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lista de Presença</h2>
<p class="lead">Atividade: <strong><?= $atividade['nome'] ?></strong> (Data: <?= date('d/m/Y', strtotime($atividade['data_atividade'])) ?>)</p>
<a href="atividades.php" class="btn btn-secondary mb-4">← Voltar para Atividades</a>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card p-3 bg-light shadow-sm">
            <h5>Adicionar Membro à Atividade</h5>
            <form method="post">
                <input type="hidden" name="adicionar_membro" value="1">
                <div class="mb-3">
                    <label class="form-label">Selecione o Membro Presente:</label>
                    <select name="membro_id" class="form-select" required>
                        <option value="">-- Selecione --</option>
                        <?php foreach ($membrosDisponiveis as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Confirmar Presença ✓</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card p-3 shadow-sm">
            <h5>Membros Presentes Registrados</h5>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($participantes) > 0): ?>
                        <?php foreach ($participantes as $p): ?>
                            <tr>
                                <td><?= $p['nome'] ?></td>
                                <td><span class="badge bg-secondary"><?= $p['cargo'] ?></span></td>
                                <td>
                                    <a href="remover_presenca.php?id=<?= $p['part_id'] ?>&atividade_id=<?= $atividade_id ?>" class="btn btn-sm btn-danger">
                                        Retirar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Ninguém registrou presença ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    require_once("rodape.php");
?>