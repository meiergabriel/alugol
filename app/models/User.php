<?php
// app/models/User.php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../core/Model.php';

class User extends Model {
    private $conn;
    private $table = 'usuarios';

    public $id;
    public $nome;
    public $email;
    public $senha;
	public $telefone;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

	public function findById($id) {
		$query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET nome=:nome, email=:email, senha=:senha, telefone=:telefone";
        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($this->senha, PASSWORD_BCRYPT);

        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR); // Ligação para telefone

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "O email já está cadastrado! Por favor, use outro.";
            } else {
                echo "Erro ao salvar usuário: " . $e->getMessage();
            }
        }
        return false;
    }
	
	
	public function emailExists($email) {
		$query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
	
		return $stmt->fetchColumn() > 0;
	}
	

	public function update() {
		// Se a senha estiver em formato de hash, não re-hash
		if (password_get_info($this->senha)['algo']) {
			$hashedPassword = $this->senha; // Mantém a senha como está
		} else {
			$hashedPassword = password_hash($this->senha, PASSWORD_BCRYPT); // Nova senha fornecida
		}
	
        $query = "UPDATE " . $this->table . " SET nome=:nome, email=:email, senha=:senha, telefone=:telefone WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_get_info($this->senha)['algo'] ? $this->senha : password_hash($this->senha, PASSWORD_BCRYPT);

        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR); // Ligação para telefone
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
	
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
	
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
