<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {
    // Exibe a página de login
    public function login() {
        $this->view('auth/login');
    }

    // Processa o login do usuário
    public function authenticate() {
        session_start();

        $user = new User();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userData = $user->findByEmail($email);

        if ($userData && password_verify($password, $userData['senha'])) {
            // Sessão é iniciada com dados do usuário
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['nome'];

            // Redireciona para a dashboard
            header('Location: index.php?controller=auth&action=dashboard');
            exit;
        } else {
            // Redireciona para a página de login com erro
            header('Location: index.php?controller=auth&action=login&error=invalid_credentials');
            exit;
        }
    }

    // Exibe a dashboard após login
    public function dashboard() {
        $this->view('dashboard/index');
    }

    // Faz o logout do usuário
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
?>