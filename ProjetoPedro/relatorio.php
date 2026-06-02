<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    try {
        // SQL Avançado: Conta quantos membros existem em cada cargo agrupando os dados
        $query = "SELECT cargos.nome AS nome_cargo, COUNT(membros.id) AS total_membros 
                  FROM cargos 
                  LEFT JOIN membros ON cargos.id = membros.cargo_id 
                  GROUP BY cargos.id";
        $stmt = $pdo->query($query);
        $dados_relatorio = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Erro ao gerar relatório: " . $e->getMessage() . "</div>";
        $dados_relatorio = [];
    }
?>

<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Relatório: Quantidade de Membros por Cargo</h2>
        <button onclick="window.print()" class="btn btn-outline-secondary d-print-none">🖨️ Imprimir Relatório</button>
    </div>
    
    <p class="text-muted d-print-none">Este relatório apresenta uma visão analítica da associação, exibindo o total de membros vinculados a cada cargo cadastrado no sistema.</p>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Cargo / Função</th>
                <th class="text-center" style="width: 200px;">Total de Membros Alocados</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $gran_total = 0;
            if (count($dados_relatorio) > 0): 
            ?>
                <?php foreach ($dados_relatorio as $linha): ?>
                    <tr>
                        <td><strong><?= $linha['nome_cargo'] ?></strong></td>
                        <td class="text-center">
                            <span class="badge bg-primary fs-6"><?= $linha['total_membros'] ?></span>
                        </td>
                    </tr>
                    <?php $gran_total += $linha['total_membros']; ?>
                <?php endforeach; ?>
                <tr class="table-group-divider">
                    <td><h5><strong>Total Geral de Associados</strong></h5></td>
                    <td class="text-center"><h5><strong><span class="badge bg-success fs-5"><?= $gran_total ?></span></strong></h5></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">Nenhum dado encontrado para gerar o relatório.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
    require_once("rodape.php");
?>