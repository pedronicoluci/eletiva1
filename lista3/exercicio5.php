<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 5</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 5</h1>
<form method="post">
<div class="mb-3">
              <label for="mes" class="form-label">Digite o número do mês:</label>
              <input type="number" id="mes" name="mes" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mes = $_POST['mes'];

        switch ($mes) {
            case "1":
                echo "<p>1 - Janeiro</p>";
                break;
            
            case "2":
                echo "<p>2 - Fevereiro</p>";
                break;
            
            case "3":
                echo "<p>3 - Março</p>";
                break;

            case "4":
                echo "<p>4 - Abril</p>";
                break;

            case "5":
                echo "<p>5 - Maio</p>";
                break;

            case "6":
                echo "<p>6 - Junho</p>";
                break;

            case "7":
                echo "<p>7 - Julho</p>";
                break;

            case "8":
                echo "<p>8 - Agosto</p>";
                break;
            
            case "9":
                echo "<p>9 - Setembro</p>";
                break;

            case "10":
                echo "<p>10 - Outubro</p>";
                break;
            
            case "11":
                echo "<p>11 - Novembro</p>";
                break;

            case "12":
                echo "<p>12 - Dezembro</p>";
                break;

            default:
                echo "Não existe mês $mes.";
                break;
        }
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>