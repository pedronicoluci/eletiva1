<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SURICATOS M.C. - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
          background-color: #121214;
          color: #ffffff;
      }
      .login-card {
          background-color: #1e1e24;
          border: 1px solid #ffc107;
          border-radius: 8px;
      }
      .form-control {
          background-color: #2b2b36;
          border: 1px solid #444;
          color: #fff;
      }
      .form-control:focus {
          background-color: #2b2b36;
          border-color: #ffc107;
          color: #fff;
          box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
      }
      .form-control::placeholder {
          color: #a0a0a5 !important;
          opacity: 1;
      }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

  <div class="card p-4 shadow login-card" style="width: 100%; max-width: 400px;">
    <h3 class="text-center text-warning mb-2">SURICATOS M.C.</h3>
    <h6 class="text-center text-white mb-4">Gestão de Integrantes & Comboios</h6>

    <form method="post">
      <div class="mb-3">
        <label class="form-label text-secondary">E-mail</label>
        <input name="email" type="email" class="form-control" placeholder="usuario@clube.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label text-secondary">Senha</label>
        <input name="senha" type="password" class="form-control" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn btn-warning w-100 fw-bold">ENTRAR</button>
    </form>

    <?php
    require_once('conexao.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try {
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
      <small class="text-secondary">Não tem conta? <a href="cadastro.php" class="text-warning text-decoration-underline">Cadastre-se</a></small>
    </div>
  </div>

</body>
</html>