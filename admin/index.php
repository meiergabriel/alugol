<?php
// Exibe erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define o caminho de sessão usando um caminho relativo
session_save_path(__DIR__ . '/sections');
session_name('alugol_unique_session');
session_start();

// Verificação se o usuário está logado
$isLoginPage = isset($_GET['controller']) && $_GET['controller'] === 'auth' && ($_GET['action'] === 'login' || $_GET['action'] === 'authenticate');
if (!$isLoginPage && !isset($_SESSION['user_id'])) {
    // Se não estiver logado e não estiver na página de login, redireciona para o login
    header('Location: index.php?controller=auth&action=login');
    exit;
}

// Roteamento básico para os controladores
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';
$id = $_GET['id'] ?? null; // Captura o ID da URL, se presente

// Define o nome do arquivo do controlador
$controllerFile = 'app/controllers/' . ucfirst($controller) . 'Controller.php';
$controllerClassName = ucfirst($controller) . 'Controller';

// Verifica se é o controlador de agendamentos
if ($controller === 'agendamento') {
    require_once 'app/controllers/AgendamentoController.php';
    $agendamentoController = new AgendamentoController();

    // Processa as ações específicas para agendamentos
	switch ($action) {
		case 'index':
			$agendamentoController->index();
			break;
		case 'getAgendamentosByCampoId':
			$campoId = $_GET['campo_id'] ?? null;
			if ($campoId) {
				$agendamentoController->getAgendamentosByCampoId($campoId);
			} else {
				echo "ID do campo não fornecido.";
			}
			break;
		case 'create':
			$agendamentoController->create();
			break;
		case 'update':
			$agendamentoController->update();
			break;
		case 'delete':
			$agendamentoController->delete();
			break;
		default:
			echo "Ação de agendamento inválida.";
			break;
	}
} else {
    // Lógica de roteamento original para outros controladores
    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        // Verifica se a classe do controlador existe
        if (class_exists($controllerClassName)) {
            $controllerObj = new $controllerClassName();

            // Verifica se o método de ação existe no controlador
            if (method_exists($controllerObj, $action)) {
                // Chama o método com ou sem o ID, conforme necessário
                if ($id) {
                    $controllerObj->{$action}($id);
                } else {
                    $controllerObj->{$action}();
                }
            } else {
                echo "Ação '$action' não encontrada no controlador '$controllerClassName'.";
            }
        } else {
            echo "Controlador '$controllerClassName' não encontrado.";
        }
    } else {
        echo "Arquivo de controlador '$controllerFile' não encontrado.";
    }
}
?>
