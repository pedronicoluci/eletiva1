<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if (!isset($_GET['id'])) {
        header("Location: membros.php");
        exit();
    }
    $id = $_GET['id'];

    // 1. Busca os dados do membro e a lista de cargos
    try {
        $stmtMembro = $pdo->prepare("SELECT * FROM membros WHERE id = ?");
        $stmtMembro->execute([$id]);
        $membro = $stmtMembro->fetch(PDO::FETCH_ASSOC);

        if (!$membro) { die("Membro não encontrado!"); }

        $stmtCargos = $pdo->query("SELECT id, nome FROM cargos");
        $cargos = $stmtCargos->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }

    // 2. Processa a alteração
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $cargo_id = $_POST["cargo_id"];

        try {
            $stmt = $pdo->prepare("UPDATE membros SET nome = ?, email = ?, cargo_id = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $cargo_id, $id]);

            header("Location: membros.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao atualizar: " . $e->getMessage() . "</div>";
        }
    }
?>

<h1>Alterar Dados do Membro</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" value="<?= $membro['nome'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= $membro['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="cargo_id" class="form-label">Cargo:</label>
        <select id="cargo_id" name="cargo_id" class="form-select" required>
            <?php foreach ($cargos as $cargo): ?>
                <option value="<?= $cargo['id'] ?>" <?= $cargo['id'] == $membro['cargo_id'] ? 'selected' : '' ?>>
                    <?= $cargo['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="membros.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
    require_once("rodape.php");
?>