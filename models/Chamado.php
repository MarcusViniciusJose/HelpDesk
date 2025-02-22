<?php
require_once __DIR__ . '/../config/database.php';

class Chamado{
    private $conn;
    private $table = 'chamado';

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function criarChamado($id_usuario_criador, $id_departamento, $id_categoria, $titulo, $descricao, $prioridade){
        $query = "INSERT INTO $this->table (id_usuario_criador, id_departamento, id_categoria, titulo, descricao, prioridade)
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiisss", $id_usuario_criador, $id_departamento, $id_categoria, $titulo, $descricao, $prioridade);
        return $stmt->execute();
    }

    public function listarChamados(){
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarChamadoPorId($id_chamado){
        $query = "SELECT * FROM $this->table WHERE id_chamado = :id_chamado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_chamado', $id_chamado);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatusChamado($id_chamado, $status){
        $query = "UPDATE $this->table SET status_chamado = :status WHERE id_chamado = :id_chamado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_chamado', $id_chamado);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function deletarChamado($id_chamado){
        $query = "DELETE FROM $this->table WHERE id_chamado = :id_chamado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_chamado', $id_chamado);
        return $stmt->execute();
    }
}





?>