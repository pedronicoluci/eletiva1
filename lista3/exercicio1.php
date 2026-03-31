<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 1</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 1</h1>
<form method="post">
<div class="mb-3">
              <label for="numero1" class="form-label">Digite o primeiro número: </label>
              <input type="number" id="numero1" name="numero1" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero2" class="form-label">Digite o segundo número: </label>
              <input type="number" id="numero2" name="numero2" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero3" class="form-label">Digite o terceiro número: </label>
              <input type="number" id="numero3" name="numero3" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero4" class="form-label">Digite o quarto número: </label>
              <input type="number" id="numero4" name="numero4" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero5" class="form-label">Digite o quinto número: </label>
              <input type="number" id="numero5" name="numero5" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero6" class="form-label">Digite o sexto número: </label>
              <input type="number" id="numero6" name="numero6" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numero7" class="form-label">Digite o sétimo número: </label>
              <input type="number" id="numero7" name="numero7" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero1 = $_POST["numero1"];
        $numero2 = $_POST["numero2"];
        $numero3 = $_POST["numero3"];
        $numero4 = $_POST["numero4"];
        $numero5 = $_POST["numero5"];
        $numero6 = $_POST["numero6"];
        $numero7 = $_POST["numero7"];

        $menor = $numero1;
        $posicao = 1;

        if($numero2 < $menor){
            $menor = $numero2;
            $posicao = 2;
        }

        if($numero3 < $menor){
            $menor = $numero3;
            $posicao = 3;
        }

        if($numero4 < $menor){
            $menor = $numero4;
            $posicao = 4;
        }

        if($numero5 < $menor){
            $menor = $numero5;
            $posicao = 5;
        }

        if($numero6 < $menor){
            $menor = $numero6;
            $posicao = 6;
        }

        if($numero7 < $menor){
            $menor = $numero7;
            $posicao = 7;
        }

        echo "<p>Menor valor: $menor | Posição: $posicao º</p>";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>