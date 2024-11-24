<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Área Administrativa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado para centralizar o formulário e ajustar o layout */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 150px;
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo da empresa -->
		<a href="https://projetos.vowt.dev.br/gabriel-testes/alugol">
		<img src="/gabriel-testes/alugol/uploads/logo.png" alt="Logo Alugol" class="logo">
		</a>
        <!-- Título da página -->
        <h2 class="form-title">Área Administrativa</h2>

        <!-- Exibe a mensagem de erro se o parâmetro "error" estiver presente na URL -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <div class="alert alert-danger text-center">
                Email ou senha incorretos. Por favor, tente novamente.
            </div>
        <?php endif; ?>

        <!-- Formulário de login -->
        <form method="POST" action="index.php?controller=auth&action=authenticate">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Digite seu email">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Digite sua senha">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
    </div>
</body>
</html>
