<?php
// Ativa a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ajuste os caminhos relativos para o local correto
include 'app/views/header.php';
require_once 'app/controllers/UserController.php';

// Verifica se há parâmetros de controller e action na URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Página inicial padrão
if ($controller === null && $action === null) {
    // echo '<div class="jumbotron mt-4">';
    // echo '<h1 class="display-4">Bem-vindo ao Alugol!</h1>';
    // echo '<p class="lead">Esta é a página inicial. Navegue para outras seções utilizando o menu.</p>';
    // echo '</div>';
	include 'app/views/slideshow.php';

    // Carrega e exibe os campos
    require_once 'app/controllers/CampoController.php';
    $campoController = new CampoController();
    $campoController->index();

    include 'app/views/footer.php';
    exit;
}

// Carrega o controlador solicitado
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'app/controllers/' . $controllerName . '.php';

// Verifica se o controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerObj = new $controllerName();

    // Verifica se o método existe no controlador
    if (method_exists($controllerObj, $action)) {
        // Verifica o método HTTP
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Passa o ID para o método, se existir, durante o POST
            $id ? $controllerObj->{$action}($id) : $controllerObj->{$action}();
        } else {
            // Passa o ID para o método, se existir, durante o GET
            $id ? $controllerObj->{$action}($id) : $controllerObj->{$action}();
        }
    } else {
        echo "Ação não encontrada.";
    }
} else {
    echo "Controlador não encontrado.";
}
?>
