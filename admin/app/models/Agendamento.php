<?php
// admin/app/models/Agendamento.php

require_once __DIR__ . '/../../config/database.php';
use AdminConfig\Database; // Importa o namespace correto

class Agendamento {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Lista os agendamentos de um campo específico
    public function getByCampoId($campoId) {
        $query = "SELECT * FROM agendamentos WHERE campo_id = :campo_id ORDER BY data_inicio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':campo_id', $campoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria um novo agendamento
    public function create($data) {
        try {
            $query = "INSERT INTO agendamentos (campo_id, title, data_inicio, data_fim, status_pagamento, valor_total) 
                      VALUES (:campo_id, :title, :data_inicio, :data_fim, :status_pagamento, :valor_total)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':campo_id', $data['campo_id']);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':data_inicio', $data['data_inicio']);
            $stmt->bindParam(':data_fim', $data['data_fim']);
            $stmt->bindParam(':status_pagamento', $data['status_pagamento']);
            $stmt->bindParam(':valor_total', $data['valor_total']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar agendamento: " . $e->getMessage());
            return false;
        }
    }

    // Atualiza um agendamento
    public function update($id, $data) {
        $query = "UPDATE agendamentos SET title=:title, data_inicio=:data_inicio, data_fim=:data_fim, 
                  status_pagamento=:status_pagamento, valor_total=:valor_total WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':data_inicio', $data['data_inicio']);
        $stmt->bindParam(':data_fim', $data['data_fim']);
        $stmt->bindParam(':status_pagamento', $data['status_pagamento']);
        $stmt->bindParam(':valor_total', $data['valor_total']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Exclui um agendamento
    public function delete($id) {
        $query = "DELETE FROM agendamentos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}