<!-- app/views/dashboard/menu.php -->

<div class="sidebar text-white p-3">
    <!-- Logo da Alugol -->
    <div class="logo text-center mb-4">
		<a href="https://projetos.vowt.dev.br/gabriel-testes/alugol/admin/index.php?controller=auth&action=dashboard">
		<img src="/gabriel-testes/alugol/uploads/logo.png" alt="Logo Alugol" class="img-fluid">
		</a>

    </div>

    <!-- Links do Menu -->
    <nav class="nav flex-column">
        <a href="index.php?controller=auth&action=dashboard" class="nav-link text-white">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        <a href="index.php?controller=campo&action=index" class="nav-link text-white">
            <i class="fas fa-futbol mr-2"></i> Gestão de Campos
        </a>
		<a href="index.php?controller=agendamento&action=index" class="nav-link text-white">
			<i class="far fa-clock mr-2"></i> Gestão de Horários
		</a>
		<a href="https://projetos.vowt.dev.br/gabriel-testes/alugol/" class="nav-link text-white">
           <i class="fas fa-house-user"></i> Ir para a página inicial
        </a>
    </nav>
</div>
