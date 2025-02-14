<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController{
    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }

    public function criarUsuario(){
        $dados = json_decode(file_get_contents("php://input"), true);
        if($this->usuario->criarUsuario($dados['nome'], $dados['email'], $dados['login'], $dados['senha'], $dados['tipo'])){
            echo json_encode(["mensagem" => "Usuário criado com sucesso"]);
        }else{
            http_response_code(400);
            echo json_encode(["erro" => "Erro ao criar usuário"]);
        }
    }

    public function autenticarUsuario(){
        $dados = json_encode(file_get_contents("php://input"), true);
        $usuario = $this->usuario->autenticarUsuario($dados['login'], $dados['senha']);


        if($usuario){
            echo json_encode(["mensagem" => "Login bem sucedido", "usuário" => $usuario]);
        }else{
            http_response_code(401);
            echo json_encode(["erro" => "Credenciais inválidas"]);
        }
    }
}

?>