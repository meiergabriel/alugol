<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/gabriel-testes/alugol/index.php">
        <img src="/gabriel-testes/alugol/uploads/logo.png" alt="Alugol Logo" class="logo-responsive">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/gabriel-testes/alugol/index.php">Página Inicial</a>
            </li>
            <?php // if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/gabriel-testes/alugol/index.php?controller=user&action=index">Listagem de Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/gabriel-testes/alugol/index.php?controller=user&action=create">Criar Novo Usuário</a> -->
                </li>
            <?php // endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="/gabriel-testes/alugol/admin">Área administrativa</a>
            </li>
        </ul>
    </div>
</nav>
