<?php
require_once __DIR__ . '/../models/Chamado.php';

class ChamadoController{
    private $chamadoModel;

    public function __construct(){
        $this->chamadoModel = new Chamado();

    }

    public function criarChamado(){
        $dados = json_decode(file_get_contents("php://input"), true);

        if(!isset($dados['id_usuario_criador'], $dados['id_departamento'], $dados['id_categoria'], $dados['titulo'], $dados['descricao'], $dados['prioridade'])){
            http_response_code(400);
            echo json_encode(["erro" => "Dados incompleto"]);
            return;
        }

        $sucesso = $this->chamadoModel->criarChamado(
            $dados['id_usuario_criador'],
            $dados['id_departamento'],
            $dados['id_categoria'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['prioridade']
        );

        if($sucesso){
            http_response_code(201);
            echo json_encode(["mensagem" => "Chamado criado com sucesso!"]);

        }else{
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao criar chamado"]);
        }
    }
    
    public function listarChamados(){
        $chamados = $this->chamadoModel->listarChamados();
        echo json_encode($chamados);

    }

    public function buscarChamadoPorId($id){
        $chamado = $this->chamadoModel->buscarChamadoPorId($id);

        if($chamado){
            echo json_encode($chamado);
        }else{
            http_response_code(404);
            echo json_encode(["erro" => "Chamado não encontrado"]);
        }
    }

    public function atualizarStatusChamado(){
        $dados = json_decode(file_get_contents("php://input"), true);

        if(!isset($dados['id_chamado'], $dados['status'])){
            http_response_code(400);
            echo json_encode(["erro" => "Dados incompletos"]);
            return;
        }

        $sucesso = $this->chamadoModel->atualizarStatusChamado($dados['id_chamado'], $dados['status']);

        if($sucesso){
            echo json_encode(["mensagem" => "Status atualizado com sucesso"]);

        }else{
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao atualizar o status"]);
        }
    }

    public function deletarChamado($id){
        $sucesso = $this->chamadoModel->deletarChamado($id);

        if($sucesso){
            echo json_encode(["mensagem" => "Chamdo deletado com sucesso"]);
        }else{
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao deletar chamado"]);
        }
    }
}





?>