<?php
    session_start();
    if (!isset($_SESSION["acesso"]) || $_SESSION["acesso"] == false){
        header("location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
</head>
<body>
    <p>Seja bem vindo, <?= $_SESSION["nome"] ?>!</p>
    <p><a href="logout.php">Sair do Sistema</a></p>
</body>
</html>