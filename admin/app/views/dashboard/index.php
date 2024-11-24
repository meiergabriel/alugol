<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Área Administrativa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link href="app/views/dashboard/admin.css" rel="stylesheet"> <!-- Incluindo o CSS externo -->
	    <!-- Favicon -->
		<link rel="icon" href="/gabriel-testes/alugol/uploads/fav.png" type="image/png">
</head>
<body>
    <div class="content-wrapper">
        <!-- Inclui o Menu Lateral -->
        <?php include 'app/views/dashboard/menu.php'; ?>

        <!-- Conteúdo Principal -->
        <div class="content">
            <?php
            // Inicie a sessão se ela não estiver iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Recupera o nome do usuário da sessão
            $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário';
            ?>
            
			<div class="welcome-container" style="background: linear-gradient(90deg, #1b5e20, #004d40); padding: 20px; border-radius: 8px; color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
				<h2 style="font-size: 28px; font-weight: bold; color: #e0f7fa; margin-bottom: 10px;">
					<i class="fas fa-user-circle" style="color: #b2ff59; margin-right: 10px;"></i>
					Bem-vindo, <span style="color: #b2ff59;"><?php echo htmlspecialchars($userName); ?></span>!
				</h2>
				<p style="font-size: 18px; color: #e0f7fa; margin: 0;">
					Você está logado na área administrativa. Aproveite sua gestão!
				</p>
			</div>


			<div class="row mt-4">
				<div class="container d-flex justify-content-center">
					<div class="col-md-6 mb-3">
						<?php include 'app/views/dashboard/campo_count.php'; ?>
					</div>
					<div class="col-md-6 mb-3">
						<?php include 'app/views/dashboard/campo_summary.php'; ?>
					</div>
				</div>
			</div>

        </div>
    </div>
</body>
</html>
