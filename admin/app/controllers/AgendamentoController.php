<?php
// admin/app/controllers/AgendamentoController.php

require_once __DIR__ . '/../models/Agendamento.php';
require_once __DIR__ . '/../models/Campo.php'; // Adicionando o modelo de Campo
require_once __DIR__ . '/../../core/Controller.php';

class AgendamentoController extends Controller {

    private $agendamentoModel;

    public function __construct() {
        $this->agendamentoModel = new Agendamento();
    }

    // Lista os agendamentos de um campo específico
	public function getAgendamentosByCampoId($campoId) {
		header('Content-Type: application/json');
	
		if (!$campoId) {
			echo json_encode(['status' => 'error', 'message' => 'Campo ID não fornecido.']);
			return;
		}
	
		$agendamentos = $this->agendamentoModel->getByCampoId($campoId);
	
		// Formata os agendamentos para o FullCalendar
		$eventos = [];
		foreach ($agendamentos as $agendamento) {
			$eventos[] = [
				'id' => $agendamento['id'],
				'title' => $agendamento['title'],
				'start' => $agendamento['data_inicio'],
				'end' => $agendamento['data_fim'],
				'color' => $agendamento['status_pagamento'] === 'confirmado' ? 'green' : 'red',
				'valor_total' => $agendamento['valor_total']
			];
		}
	
		echo json_encode($eventos);
	}
	
	public function index() {
		// Instancia o modelo de Campo para buscar os campos do usuário logado
		$campoModel = new Campo();
		$userId = $_SESSION['user_id'];
		$campos = $campoModel->getByUserId($userId);
		
		$this->view('agendamento/index', ['campos' => $campos]);
	}
	
    // Cria um novo agendamento
	public function create() {
		if (!isset($_POST['campo_id'], $_POST['title'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['status_pagamento'])) {
			echo json_encode(['status' => 'error', 'message' => 'Dados incompletos para criar o agendamento.']);
			return;
		}
		
		$campoModel = new Campo();
		$campo = $campoModel->findById($_POST['campo_id']);
		
		if (!$campo) {
			echo json_encode(['status' => 'error', 'message' => 'Campo não encontrado.']);
			return;
		}
		
		// Calcula a duração em horas
		$dataInicio = new DateTime($_POST['data_inicio']);
		$dataFim = new DateTime($_POST['data_fim']);
		$interval = $dataInicio->diff($dataFim);
		$duracaoHoras = $interval->h + ($interval->i / 60);
		
		// Calcula o valor total com base no valor por hora do campo
		$valorTotal = $campo['valor_por_hora'] * $duracaoHoras;
		
		$data = [
			'campo_id' => $_POST['campo_id'],
			'title' => $_POST['title'],
			'data_inicio' => $_POST['data_inicio'],
			'data_fim' => $_POST['data_fim'],
			'status_pagamento' => $_POST['status_pagamento'],
			'valor_total' => $valorTotal
		];
		// header('Content-Type: application/json');
		
		if ($this->agendamentoModel->create($data)) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Erro ao inserir no banco de dados.']);
		}
	}
	
    // Atualiza um agendamento
    public function update() {
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title'],
            'data_inicio' => $_POST['data_inicio'],
            'data_fim' => $_POST['data_fim'],
            'status_pagamento' => $_POST['status_pagamento'],
            'valor_total' => $_POST['valor_total']
        ];

        if ($this->agendamentoModel->update($id, $data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // Exclui um agendamento
    public function delete() {
        $id = $_POST['id'];
        if ($this->agendamentoModel->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function getAgendamentosPorCampo($campoId) {
        header('Content-Type: application/json');
        $agendamentos = $this->agendamentoModel->getByCampoId($campoId);
        echo json_encode($agendamentos);
    }
}
