<?php
// app/controllers/CampoController.php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Campo.php';

class CampoController extends Controller {
    public function index() {
        $campo = new Campo();
        $userId = $_SESSION['user_id'];
        $campos = $campo->getByUserId($userId);
        $this->view('campo/index', ['campos' => $campos]);
    }

    public function create() {
        $this->view('campo/create');
    }

    public function store() {
        $campoModel = new Campo();

        // Atribui os dados do campo
        $campoModel->nome = $_POST['nome'];
        $campoModel->descricao = $_POST['descricao'];
        $campoModel->dias_funcionamento = implode(',', $_POST['dias_funcionamento']);
        $campoModel->horario_inicio = $_POST['horario_inicio'];
        $campoModel->horario_fim = $_POST['horario_fim'];
        $campoModel->valor_por_hora = $_POST['valor_por_hora'];
        $campoModel->google_maps_script = $_POST['google_maps_script'];
        $campoModel->usuario_id = $_SESSION['user_id'];

        $uploadDir = __DIR__ . '/../../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Processa o upload da imagem, se houver
        if (isset($_FILES['imagens']) && $_FILES['imagens']['error'] === UPLOAD_ERR_OK) {
            $uploadFile = $uploadDir . basename($_FILES['imagens']['name']);
            if (move_uploaded_file($_FILES['imagens']['tmp_name'], $uploadFile)) {
                $campoModel->imagens = $_FILES['imagens']['name'];
            } else {
                echo "Erro ao salvar a imagem.";
                return;
            }
        }

        if ($campoModel->create()) {
            header('Location: index.php?controller=campo&action=index');
            exit;
        } else {
            echo "Erro ao criar campo.";
        }
    }

    public function edit($id) {
        $campoModel = new Campo();
        $campo = $campoModel->findById($id);

        if (!$campo) {
            echo "Campo não encontrado.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $campoData = [
                'nome' => $_POST['nome'],
                'descricao' => $_POST['descricao'],
                'dias_funcionamento' => implode(',', $_POST['dias_funcionamento']),
                'horario_inicio' => $_POST['horario_inicio'],
                'horario_fim' => $_POST['horario_fim'],
                'valor_por_hora' => $_POST['valor_por_hora'],
                'google_maps_script' => $_POST['google_maps_script']
            ];

            // Verifica se uma nova imagem foi enviada
            if (isset($_FILES['imagens']) && $_FILES['imagens']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../uploads/';
                $uploadFile = $uploadDir . basename($_FILES['imagens']['name']);
                
                if (move_uploaded_file($_FILES['imagens']['tmp_name'], $uploadFile)) {
                    $campoData['imagens'] = $_FILES['imagens']['name'];
                    
                    if (!empty($campo['imagens']) && file_exists($uploadDir . $campo['imagens'])) {
                        unlink($uploadDir . $campo['imagens']);
                    }
                } else {
                    echo "Erro ao salvar a nova imagem.";
                    return;
                }
            }

            if ($campoModel->update($id, $campoData)) {
                header('Location: index.php?controller=campo&action=index');
                exit;
            } else {
                echo "Erro ao atualizar o campo.";
            }
        }

        $this->view('campo/edit', ['campo' => $campo]);
    }

    public function delete($id) {
        $campoModel = new Campo();
        if ($campoModel->delete($id)) {
            header('Location: index.php?controller=campo&action=index');
            exit;
        } else {
            echo "Erro ao excluir o campo.";
        }
    }

    public function view($viewPath, $data = []) {
        extract($data);
        require_once 'app/views/' . $viewPath . '.php';
    }
}
