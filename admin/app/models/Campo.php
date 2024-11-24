<?php
// admin/app/models/Campo.php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../core/Model.php';
use AdminConfig\Database; // Importa o namespace correto

class Campo extends Model {
    private $conn;
    private $table = 'campos';

    public $id;
    public $nome;
    public $descricao;
    public $imagens;
    public $dias_funcionamento;
    public $horario_inicio;
    public $horario_fim;
    public $usuario_id;
    public $valor_por_hora;         // Novo campo
    public $google_maps_script;     // Novo campo

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create() {
        $query = "INSERT INTO campos (nome, descricao, imagens, dias_funcionamento, horario_inicio, horario_fim, usuario_id, valor_por_hora, google_maps_script) 
                  VALUES (:nome, :descricao, :imagens, :dias_funcionamento, :horario_inicio, :horario_fim, :usuario_id, :valor_por_hora, :google_maps_script)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':imagens', $this->imagens);
        $stmt->bindParam(':dias_funcionamento', $this->dias_funcionamento);
        $stmt->bindParam(':horario_inicio', $this->horario_inicio);
        $stmt->bindParam(':horario_fim', $this->horario_fim);
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':valor_por_hora', $this->valor_por_hora);
        $stmt->bindParam(':google_maps_script', $this->google_maps_script);

        return $stmt->execute();
    }

    public function getByUserId($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM campos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = "UPDATE campos SET 
                    nome = :nome, 
                    descricao = :descricao, 
                    dias_funcionamento = :dias_funcionamento, 
                    horario_inicio = :horario_inicio, 
                    horario_fim = :horario_fim, 
                    valor_por_hora = :valor_por_hora, 
                    google_maps_script = :google_maps_script";
                    
        // Adiciona a coluna 'imagens' na query somente se uma nova imagem for passada
        if (!empty($data['imagens'])) {
            $query .= ", imagens = :imagens";
        }
        
        $query .= " WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->bindParam(':dias_funcionamento', $data['dias_funcionamento']);
        $stmt->bindParam(':horario_inicio', $data['horario_inicio']);
        $stmt->bindParam(':horario_fim', $data['horario_fim']);
        $stmt->bindParam(':valor_por_hora', $data['valor_por_hora']);
        $stmt->bindParam(':google_maps_script', $data['google_maps_script']);
        $stmt->bindParam(':id', $id);
    
        // Liga o parâmetro 'imagens' somente se a imagem foi atualizada
        if (!empty($data['imagens'])) {
            $stmt->bindParam(':imagens', $data['imagens']);
        }
    
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM campos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Função para contar todos os campos cadastrados para um usuário específico
    public function countAllCampos($userId) {
        $query = "SELECT COUNT(*) as total FROM campos WHERE usuario_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // Função para obter uma lista breve dos campos para um usuário específico
    public function getBriefCampos($userId) {
        $query = "SELECT nome, dias_funcionamento FROM campos WHERE usuario_id = :userId LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}