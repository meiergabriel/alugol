<?php
// app/controllers/CampoController.php

require_once __DIR__ . '/../../core/Controller.php'; 
require_once __DIR__ . '/../models/Campo.php';
require_once __DIR__ . '/../../admin/app/models/Agendamento.php'; // Caminho correto para a model Agendamento

class CampoController extends Controller {
    
    private $campoModel;
    private $agendamentoModel;

    public function __construct() {
        $this->campoModel = new Campo();
        $this->agendamentoModel = new Agendamento(); // Instância da model Agendamento
    }

    public function index() {
        $campos = $this->campoModel->getAllCamposWithOwner();
        $this->view('campos/list', ['campos' => $campos]);
    }

	public function getCampoDetails() {
		$campoId = $_GET['campo_id'] ?? null;
	
		if (!$campoId) {
			echo "ID do campo não fornecido.";
			return;
		}
	
		$campoModel = new Campo();
		$campo = $campoModel->findById($campoId);
	
		$agendamentoModel = new Agendamento();
		$agendamentos = $agendamentoModel->getByCampoId($campoId);
	
		ob_start();
		include 'app/views/campos/campo_details.php'; // Inclui somente o conteúdo específico
		$content = ob_get_clean();
	
		echo $content; // Exibe o conteúdo para o modal sem o layout global
	}

	public function getAgendamentosPorCampo() {
		header('Content-Type: application/json');
	
		// Obtém o ID do campo da requisição
		$campoId = $_GET['campo_id'] ?? null;
		if (!$campoId) {
			echo json_encode(['error' => 'Campo ID não fornecido']);
			exit;
		}
	
		// Inclui o modelo Agendamento e busca os agendamentos
		require_once __DIR__ . '/../../admin/app/models/Agendamento.php';
		$agendamentoModel = new Agendamento();
		$agendamentos = $agendamentoModel->getByCampoId($campoId);
	
		// Retorna os agendamentos como JSON e interrompe a execução
		echo json_encode($agendamentos);
		exit;
	}
	
}
