<?php
    // Configurações base
    $host = "127.0.0.1";
    $banco = "projetophp";
    $usuario = "root";
    $senha = "";

    // Tentamos primeiro a porta 3307, se falhar, tentamos a 3306
    try {
        $dominio = "mysql:host=$host;port=3307;dbname=$banco;charset=utf8mb4";
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        try {
            $dominio = "mysql:host=$host;port=3306;dbname=$banco;charset=utf8mb4";
            $pdo = new PDO($dominio, $usuario, $senha);
        } catch (Exception $err) {
            die("Erro crítico: Não foi possível conectar ao MySQL em nenhuma das portas padrão (3306/3307). Verifique se o MySQL do XAMPP está ligado! Detalhes: " . $err->getMessage());
        }
    }

    // Ativa o modo de erros do PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>