<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    try {
        $stmtCargos = $pdo->query("SELECT id, nome FROM cargos");
        $cargos = $stmtCargos->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao carregar cargos: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $cargo_id = $_POST["cargo_id"];

        try {
            $stmt = $pdo->prepare("INSERT INTO membros (nome, email, cargo_id) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $cargo_id]);

            header("Location: membros.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao salvar membro: " . $e->getMessage() . "</div>";
        }
    }
?>

<h1>Novo Membro</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Membro:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cargo_id" class="form-label">Patente:</label>
        <select id="cargo_id" name="cargo_id" class="form-select" required>
            <option value="">-- Selecione uma Patente --</option>
            <?php foreach ($cargos as $cargo): ?>
                <option value="<?= $cargo['id'] ?>"><?= $cargo['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Membro</button>
    <a href="membros.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>