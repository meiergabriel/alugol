<?php
// app/models/Campo.php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../core/Model.php';

class Campo extends Model {
	private $conn;
	private $table = 'campos';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllCamposWithOwner() {
        $query = "SELECT 
                    campos.*, 
                    usuarios.nome AS nome_proprietario 
                  FROM 
                    campos 
                  JOIN 
                    usuarios 
                  ON 
                    campos.usuario_id = usuarios.id";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function findById($id) {
		$query = "
			SELECT c.*, u.nome AS nome_proprietario, u.telefone
			FROM campos AS c
			JOIN usuarios AS u ON c.usuario_id = u.id
			WHERE c.id = :id
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
