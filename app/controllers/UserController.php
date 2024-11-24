<?php
// app/controllers/UserController.php

// Inicie a sessão apenas se ela não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está tentando acessar a listagem ou cadastro sem ser administrador
if (isset($_GET['controller']) && $_GET['controller'] === 'user' && (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true)) {
    // Se não estiver logado como administrador, redireciona para a página inicial
    header('Location: /gabriel-testes/alugol/index.php');
    exit;
}

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends Controller {
    public function index() {
        $user = new User();
        $users = $user->getAll();
        $this->view('user/index', ['users' => $users]);
    }

    public function create() {
        $this->view('user/create');
    }

	public function store() {
		$user = new User();
		$user->nome = $_POST['nome'];
		$user->email = $_POST['email'];
		$user->senha = $_POST['senha'];
		$user->telefone = $_POST['telefone']; // Captura do campo telefone
	
		if ($user->emailExists($user->email)) {
			echo "O email já está cadastrado! Por favor, use outro.";
			return;
		}
	
		if ($user->create()) {
			header('Location: index.php?controller=user&action=index');
			exit;
		} else {
			echo "Erro ao salvar usuário!";
		}
	}
    
    public function edit($id) {
        $user = new User();
        $userData = $user->findById($id);
        
        if ($userData) {
            $this->view('user/edit', ['user' => $userData]);
        } else {
            echo "Usuário não encontrado.";
        }
    }

	public function update($id) {
		$user = new User();
		$user->id = $id;
		$user->nome = $_POST['nome'];
		$user->email = $_POST['email'];
		$user->telefone = $_POST['telefone']; // Captura do campo telefone
	
		if (!empty($_POST['senha'])) {
			$user->senha = $_POST['senha'];
		} else {
			$userData = $user->findById($id);
			$user->senha = $userData['senha'];
		}
	
		if ($user->update()) {
			header('Location: index.php?controller=user&action=index');
			exit;
		} else {
			echo "Erro ao atualizar usuário!";
		}
	}

    public function delete($id) {
        $user = new User();
        $user->id = $id;

        if ($user->delete()) {
            header('Location: index.php?controller=user&action=index');
        } else {
            echo "Erro ao deletar usuário!";
        }
    }
}
?>
