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
        
        if (!$cargo) {
            die("Cargo não encontrado.");
        }
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];

        try {
            $stmt = $pdo->prepare("UPDATE cargos SET nome = ?, descricao = ? WHERE id = ?");
            $stmt->execute([$nome, $descricao, $id]);
            header("Location: cargos.php");
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erro ao atualizar: " . $e->getMessage() . "</div>";
        }
    }
?>

<h1>Editar Patente</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Patente:</label>
        <input type="text" id="nome" name="nome" class="form-control" value="<?= $cargo['nome'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" value="<?= $cargo['descricao'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>

<?php require_once("rodape.php"); ?>