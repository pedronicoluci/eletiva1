<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Sistema de Cadastro de Membros de Associação</h3>

    <form method = "post">
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input name="email" type="email" class="form-control" placeholder="Digite seu e-mail:" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input name="senha" type="password" class="form-control" placeholder="Digite sua senha:" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">ENTRAR</button>
    </form>

    <?php
    require_once('conexao.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try {
          // Lógica dinâmica: Buscando o usuário direto na tabela 'usuarios' do banco
          $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
          $stmt->execute([$email, $senha]);
          $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

          if($usuario) {
              $_SESSION["nome"] = $usuario["nome"];
              $_SESSION["acesso"] = true;
              header("Location: principal.php");
              exit();
          } else {
              $_SESSION["acesso"] = false;
              echo "<p class='text-danger text-center mt-3'>E-mail e/ou senha incorretos!</p>";
          }

        } catch(Exception $e) {
          echo "<p class='text-danger text-center mt-3'>Erro no sistema: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <div class="text-center mt-3">
      <small>Não tem conta? <a href="cadastro.php">Cadastre-se</a></small>
    </div>
  </div>

</body>
</html>