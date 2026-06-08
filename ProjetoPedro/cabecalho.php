<?php
    session_start();
    if (!isset($_SESSION["acesso"]) || $_SESSION["acesso"] == false){
        header("location: index.php");
        exit();
    }
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SURICATOS M.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e24;
            color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 900;
            letter-spacing: 1px;
            color: #ffc107 !important;
        }
        .nav-link {
            color: #e0e0e0 !important;
        }
        .nav-link:hover, .dropdown-item:hover {
            color: #ffc107 !important;
        }
        .dropdown-menu {
            background-color: #2b2b36;
            border: 1px solid #444;
        }
        .dropdown-item {
            color: #e0e0e0;
        }
        .main-container {
            background-color: #25252d;
            border: 1px solid #3a3a45;
            color: #ffffff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-warning border-2">
  <div class="container">
    <a class="navbar-brand" href="principal.php">💀 SURICATOS M.C.</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="principal.php">Início</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gerenciamento
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown2">
            <li><a class="dropdown-item" href="cargos.php">Patentes</a></li>
            <li><a class="dropdown-item" href="membros.php">Membros</a></li>
            <li><a class="dropdown-item" href="atividades.php">Atividades</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Relatórios
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown3">
            <li><a class="dropdown-item" href="relatorio.php">Membros por Patente</a></li>
            <li><a class="dropdown-item" href="relatorio_participacao.php">Presença nas Atividades</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="logout.php">Sair</a>
        </li>
      </ul>
      <span class="navbar-text text-white me-3">
         Olá, <strong class="text-warning"><?= $_SESSION["nome"] ?></strong>!
      </span>
    </div>
  </div>
</nav>
<div class="container py-4">
  <div class="main-container p-4 rounded shadow-sm">