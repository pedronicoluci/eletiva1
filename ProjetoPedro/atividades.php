<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    // LÓGICA 1: Processa o cadastro de uma nova atividade se o formulário for enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $data_atividade = $_POST['data_atividade'];

        try {
            $stmt = $pdo->prepare("INSERT INTO atividades (nome, data_atividade) VALUES (?, ?)");
            $stmt->execute([$nome, $data_grid = $data_atividade]);
            echo "<div class='alert alert-success'>Atividade cadastrada com sucesso!</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
    }

    // LÓGICA 2: Busca todas as atividades cadastradas
    try {
        $stmt = $pdo->query("SELECT * FROM atividades ORDER BY data_atividade DESC");
        $atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
        $atividades = [];
    }
?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card p-3 shadow-sm">
            <h4>Nova Atividade</h4>
            <form method="post">
                <input type="hidden" name="cadastrar" value="1">
                <div class="mb-3">
                    <label class="form-label">Nome do Evento/Atividade:</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Realização:</label>
                    <input type="date" name="data_atividade" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Criar Atividade</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-3 shadow-sm">
            <h4>Histórico de Atividades</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Atividade</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($atividades) > 0): ?>
                        <?php foreach ($atividades as $ativ): ?>
                            <tr>
                                <td><?= $ativ['id'] ?></td>
                                <td><strong><?= $ativ['nome'] ?></strong></td>
                                <td><?= date('d/m/Y', strtotime($ativ['data_atividade'])) ?></td>
                                <td>
                                    <a href="participacoes.php?atividade_id=<?= $ativ['id'] ?>" class="btn btn-sm btn-info text-white">
                                        👥 Lista de Presença
                                    </a>
                                    <!--<a href="excluir_atividade.php?id=<?= $ativ['id'] ?>" class="btn btn-sm btn-outline-danger">-->
                                        <a href="excluir_atividade.php?id=<?= $ativ['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta atividade?');">Excluir</a>
                                        <!--Excluir-->
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma atividade registrada.</td>
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