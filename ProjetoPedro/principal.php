<?php
    require_once("cabecalho.php");
?>

<div class="p-5 mb-4 bg-dark text-light rounded-3 border border-secondary shadow-sm text-center">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold text-warning">Seja bem-vindo, <?= $_SESSION["nome"] ?>!</h1>
        <p class="col-md-8 mx-auto fs-5 text-secondary">
            Você está conectado à Central de Comando do <strong>SURICATOS Moto Clube</strong>. 
            Utilize o menu superior para gerenciar os irmãos escudados, patentes e nossass próximas atividades.
        </p>
        <hr class="my-4 border-secondary style-2" style="max-width: 200px; margin: 0 auto;">
        <p class="mb-0 text-secondary small">
            <strong>Respeito</strong>, <strong>Honra</strong> e <strong>Liberdade</strong>. Boa jornada de trabalho, irmão!
        </p>
    </div>
</div>

</div>

<?php
    require_once("rodape.php");
?>