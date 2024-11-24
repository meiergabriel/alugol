<?php
// app/views/dashboard/campo_count.php

require_once __DIR__ . '/../../models/Campo.php';

$campoModel = new Campo();
$userId = $_SESSION['user_id'];
$campoCount = $campoModel->countAllCampos($userId);
?>

<div class="card text-white bg-primary shadow-lg rounded mb-4" style="max-width: 20rem;">
    <div class="card-header d-flex align-items-center">
        <i class="fas fa-futbol fa-2x mr-3"></i>
        <span style="font-size: 1.2em;">Total de Campos</span>
    </div>
    <div class="card-body text-center">
        <h2 class="display-4 font-weight-bold"><?= $campoCount ?></h2>
        <p class="card-text">Campos de futebol cadastrados no sistema.</p>
    </div>
</div>
