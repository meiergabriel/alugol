<?php
// app/views/dashboard/campo_summary.php

require_once __DIR__ . '/../../models/Campo.php';

$campoModel = new Campo();
$userId = $_SESSION['user_id'];
$campos = $campoModel->getBriefCampos($userId);
?>

<div class="card shadow-sm border-light rounded mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-list-ul mr-2"></i>Resumo dos Campos</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($campos)): ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($campos as $campo): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($campo['nome']) ?></strong>
                            <small class="d-block text-muted"><?= htmlspecialchars($campo['dias_funcionamento']) ?></small>
                        </div>
                        <span class="badge badge-primary badge-pill">Ativo</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="card-text text-muted">Nenhum campo cadastrado.</p>
        <?php endif; ?>
        <a href="index.php?controller=campo&action=index" class="btn btn-outline-primary btn-block mt-3">Gerenciar Campos</a>
    </div>
</div>
