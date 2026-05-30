<?php

    // Configuração do banco de dados local com a porta 3307 do seu XAMPP
    $dominio = "mysql:host=127.0.0.1;port=3307;dbname=projetophp;charset=utf8mb4";
    $usuario = "root";
    $senha = "";

    try {
        // Cria a conexão usando a extensão PDO do PHP
        $pdo = new PDO($dominio, $usuario, $senha);
        
        // Configura o PDO para lançar exceções em caso de erros de SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(Exception $e) {
        // Se a conexão falhar, interrompe o sistema e mostra o erro
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }

?>