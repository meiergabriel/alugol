<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {
    // Página de login para o administrador root
    public function loginRoot() {
        $this->view('auth/login_root');
    }

    // Processa o login do administrador root
    public function authenticateRoot() {
        session_start();

        // Senha estática para root
        $rootPassword = "root";
        $inputPassword = $_POST['password'] ?? '';

        // Verifica se a senha está correta
        if ($inputPassword === $rootPassword) {
            $_SESSION['is_admin'] = true;
            header('Location: index.php?controller=user&action=index');
            exit;
        } else {
            // Se a senha estiver errada, redireciona de volta
            header('Location: index.php?controller=auth&action=loginRoot&error=invalid_credentials');
            exit;
        }
    }
    
    // Faz logout do administrador root
    public function logoutRoot() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>
