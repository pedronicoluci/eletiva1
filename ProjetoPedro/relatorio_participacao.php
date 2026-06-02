<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    try {
        // SQL Avançado: Une membros, cargos e conta as presenças confirmadas na tabela participações
        $query = "SELECT membros.nome AS nome_membro, cargos.nome AS nome_cargo, COUNT(participacoes.id) AS total_presencas
                  FROM membros
                  INNER JOIN cargos ON membros.cargo_id = cargos.id
                  LEFT JOIN participacoes ON membros.id = participacoes.membro_id
                  GROUP BY membros.id
                  ORDER BY total_presencas DESC, membros.nome ASC";
                  
        $stmt = $pdo->query($query);
        $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Erro ao gerar relatório de engajamento: " . $e->getMessage() . "</div>";
        $ranking = [];
    }
?>

<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Relatório: Assiduidade e Engajamento de Membros</h2>
        <button onclick="window.print()" class="btn btn-outline-secondary d-print-none">🖨️ Imprimir</button>
    </div>
    
    <p class="text-muted d-print-none">Este relatório lista todos os membros da associação e contabiliza a quantidade total de atividades e eventos que cada um compareceu.</p>

    <table class="table table-hover table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nome do Membro</th>
                <th>Cargo / Função</th>
                <th class="text-center" style="width: 220px;">Atividades Frequentadas</th>
                <th class="text-center" style="width: 180px;">Status de Engajamento</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($ranking) > 0): ?>
                <?php foreach ($ranking as $linha): ?>
                    <tr>
                        <td><strong><?= $linha['nome_membro'] ?></strong></td>
                        <td><?= $linha['nome_cargo'] ?></td>
                        <td class="text-center">
                            <span class="badge bg-dark fs-6"><?= $linha['total_presencas'] ?></span>
                        </td>
                        <td class="text-center">
                            <?php if ($linha['total_presencas'] == 0): ?>
                                <span class="badge bg-danger">Inativo</span>
                            <?php elseif ($linha['total_presencas'] <= 2): ?>
                                <span class="badge bg-warning text-dark">Regular</span>
                            <?php else: ?>
                                <span class="badge bg-success">Alta Presença ✓</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhum membro registrado para gerar o ranking.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="mt-3 d-print-none">
        <a href="principal.php" class="btn btn-secondary">Voltar ao Início</a>
    </div>
</div>

<?php
    require_once("rodape.php");
?>