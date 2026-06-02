<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Criar Nova Conta</h3>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Nome Completo</label>
        <input name="nome" type="text" class="form-control" placeholder="Digite seu nome:" required>
      </div>

      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input name="email" type="email" class="form-control" placeholder="Digite seu e-mail:" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input name="senha" type="password" class="form-control" placeholder="Digite sua senha:" required>
      </div>

      <button type="submit" class="btn btn-success w-100">CADASTRAR</button>
    </form>

    <?php
    require_once('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try {
            // Primeiro, verifica se o e-mail já não está cadastrado
            $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmtCheck->execute([$email]);
            
            if ($stmtCheck->fetch()) {
                echo "<p class='text-danger text-center mt-3'>Este e-mail já está cadastrado!</p>";
            } else {
                // Insere o novo usuário no banco
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $senha]);

                echo "<script>
                        alert('Conta criada com sucesso! Você será redirecionado para a tela de login.');
                        window.location.href='index.php';
                      </script>";
                exit();
            }
        } catch (Exception $e) {
            echo "<p class='text-danger text-center mt-3'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <div class="text-center mt-3">
      <small>Já tem uma conta? <a href="index.php">Voltar para o Login</a></small>
    </div>
  </div>

</body>
</html>