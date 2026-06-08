<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];

        try {
            $stmt = $pdo->prepare("INSERT INTO cargos (nome, descricao) VALUES (?, ?)");
            $stmt->execute([$nome, $descricao]);

            header("Location: cargos.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao salvar: " . $e->getMessage() . "</div>";
        }
    }
?>

<h1>Nova Patente</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Patente:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição das Funções:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php require_once("rodape.php"); ?>