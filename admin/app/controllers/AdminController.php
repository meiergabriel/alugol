<?php
require_once __DIR__ . '/../../core/Controller.php';

class AdminController extends Controller {
    // Método para carregar a página inicial da dashboard
    public function index() {
        $this->view('dashboard/index');
    }
}
?>
