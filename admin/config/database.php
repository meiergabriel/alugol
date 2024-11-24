<?php
// admin/config/database.php 
namespace AdminConfig;

class Database {
    private $host = 'localhost';
    private $db_name = 'admin_gabriel-teste-nao-apagar';
    private $username = 'admin_gabriel-teste-nao-apagar';
    private $password = 'D7JbZL4G8m22sQY2AXwE';
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            // Usa \PDO para especificar que estamos usando a classe PDO global
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
