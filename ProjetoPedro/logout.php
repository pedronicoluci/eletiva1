<?php
    // Inicia a sessão para o PHP saber quem está logado
    session_start();

    // Limpa todas as variáveis salvas na sessão (como o nome e o acesso)
    $_SESSION = array();

    // Destrói a sessão completamente no servidor
    session_destroy();

    // Redireciona o usuário imediatamente para a tela de login
    header("Location: index.php");
    exit();
?>