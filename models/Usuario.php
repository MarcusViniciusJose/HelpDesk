<?php
require_once __DIR__ . '/../config/database.php';

class Usuario{
    private $conn;
    private $table = 'usuario';

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function criarUsuario($nome, $email, $login, $senha, $tipo){
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "INSERT INTO $this->table (nome, email, login, senha, tipo, criado_em)
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $login, $senhaHash, $tipo);
        return $stmt->execute();
    }

    public function autenticarUsuario($login, $senha){
        $sql = "SELECT id_usuario, nome, senha, tipo FROM $this->table WHERE login = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();


        if ($resultado && password_verify($senha, $resultado['senha'])){
            return $resultado;
        }
        return false;
    }
}

?>