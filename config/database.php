<?php
class Database{
    private $host = "localhost";
    private $db_name = "hdaero";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if($this->conn->connect_error){
                die("Erro na conexão: " . $this->conn->connect_error);

            }
        }catch (Execption $e){
            echo "Erro: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>