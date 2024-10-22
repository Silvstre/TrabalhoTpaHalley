<?php
require_once 'conexao.php';

class Equipamento {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM equipamentos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM equipamentos WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nome, $tipo, $funcao) {
        $query = "INSERT INTO equipamentos (nome, tipo, funcao) VALUES (:nome, :tipo, :funcao)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':funcao', $funcao);
        return $stmt->execute();
    }

    public function update($id, $nome, $tipo, $funcao) {
        $query = "UPDATE equipamentos SET nome = :nome, tipo = :tipo, funcao = :funcao WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':funcao', $funcao);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM equipamentos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
