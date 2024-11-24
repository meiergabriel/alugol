<?php
// core/Controller.php

class Controller {
    // Método genérico para carregar views
    public function view($view, $data = []) {
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "A view {$view} não foi encontrada.";
        }
    }
}
?>
