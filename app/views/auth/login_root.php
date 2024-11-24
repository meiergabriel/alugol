<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador - Alugol</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos normais para a tela de login root */
        body {
            background-color: #1c1c1c; /* Fundo escuro */
            color: #f5f5f5; /* Texto claro para contraste */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #2e2e2e; /* Fundo do formulário um pouco mais claro */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 0, 0, 0.5); /* Sombra avermelhada */
            max-width: 800px; /* Limita a largura máxima do container */
            width: 100%;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .alert-danger {
            background-color: #d9534f;
            color: #fff;
            border-color: #ac2925;
        }
        .warning-icon {
            font-size: 50px;
            color: #ff4c4c; /* Vermelho de alerta */
            margin-bottom: 15px;
        }

        /* CSS específico para o menu quando estiver na página de login root */
        <?php if (isset($_GET['controller']) && $_GET['controller'] === 'auth' && $_GET['action'] === 'loginRoot'): ?>
        .navbar, .navbar-nav, .navbar-brand {
            background-color: #1c1c1c !important; /* Mesma cor do fundo */
            color: #f5f5f5 !important; /* Texto claro */
            /* border-bottom: 1px solid #ff4c4c; Borda de destaque em vermelho */
			margin-bottom: 1em;
        }
        .navbar a.nav-link {
            color: #ff4c4c !important; /* Links em vermelho */
        }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="container mt-5 text-center">
        <div class="warning-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.706c.89 0 1.438-.99.982-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
        </div>
        <h2>Área Restrita - Login de Administrador</h2>

        <!-- Exibe a mensagem de erro se o parâmetro "error" estiver presente na URL -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <div class="alert alert-danger mt-4">
                <strong>Atenção!</strong> Senha incorreta. Por favor, tente novamente.
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?controller=auth&action=authenticateRoot" class="mt-4">
            <div class="form-group">
                <label for="password" class="font-weight-bold">Senha de Administrador:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block mt-3">Entrar como Administrador</button>
        </form>
    </div>
</body>
</html>
