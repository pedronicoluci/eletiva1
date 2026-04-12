<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício Reposição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <main class="container">
        <h1 class="mt-4">Exercício Reposição</h1>

        <form method="post">

            <div class="row mt-4 mb-3">
                <div class="col-12">
                    <label class="form-label">Nome: </label>
                    <input type="text" name="nome" required class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label">Número 1: </label>
                    <input type="number" name="num1" class="form-control">
                </div>

                <div class="col-6">
                    <label class="form-label">Número 2: </label>
                    <input type="number" name="num2" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label">Frase: </label>
                    <input type="text" name="frase" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label">Operação: </label>
                    <select name="operacao" required class="form-select">
                        <option value="">Selecione</option>
                        <option value="soma">Soma</option>
                        <option value="media">Média</option>
                        <option value="tabuada">Tabuada</option>
                        <option value="palindromo">Verificar Palíndromo</option>
                        <option value="produto">Cadastrar Produto</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-success rounded-0" type="submit" name="processar">Processar</button>
        </form>
    </main>

    <hr>

    <main class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = $_POST['nome'];
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $frase = $_POST['frase'];
            $operacao = $_POST['operacao'];

            echo "<h3>Resultado:</h3>";
            echo "Olá, $nome.<br><br>";

            if ($operacao == "soma") {
                echo "Soma: " . ($num1 + $num2);

            } elseif ($operacao == "media") {
                echo "Média: " . (($num1 + $num2) / 2);

            } elseif ($operacao == "tabuada") {
                echo "Tabuada do $num1:<br>";
                for ($i = 1; $i <= 10; $i++) {
                    echo "$num1 x $i = " . ($num1 * $i) . "<br>";
                }

            } elseif ($operacao == "palindromo") {
                $invert = strrev($frase);
                if ($invert == $frase)
                    echo "<p>A frase '$frase' é um palíndromo.</p>";
                else
                    echo "<p>A frase '$frase' não é palíndromo.</p>";

            } elseif ($operacao == "produto") {
                $produtos = [
                    "001" => ["nome" => "Teclado", "preco" => 120],
                    "002" => ["nome" => "Mouse", "preco" => 80],
                    "003" => ["nome" => "Monitor", "preco" => 900]
                ];

                usort($produtos, function ($a, $b) {
                    return strcmp($a["nome"], $b["nome"]);
                });

                echo "<h4>Lista de Produtos (Ordem Alfabética):</h4>";

                foreach ($produtos as $codigo => $produto) {
                    echo "Código: $codigo <br>";
                    echo "Nome: " . $produto["nome"] . "<br>";
                    echo "Preço: R$ " . $produto["preco"] . "<br><br>";
                }
            }
        }
        ?>
    </main>

</body>

</html>