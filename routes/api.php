<?php   

header("Content-type: application/json");
require_once __DIR__ . '/../controllers/Usuariocontroller.php';
require_once __DIR__ . '/../controllers/ChamadoController.php';

$usuarioController = new UsuarioController();
$chamadoController = new Chamadocontroller();

$requestUri = explode("?", $_SERVER["REQUEST_URI"], 2)[0];
$requestMethod = $_SERVER["REQUEST_METHOD"];
$dados = json_decode(file_get_contents("php://input"), true);


if($requestMethod == "POST"){
    if($requestUri == "/helpdesk/routes/api.php/usuario/criar"){
        $usuarioController->criarUsuario();
    }elseif($requestUri == "/helpdesk/routes/api.php/usuario/login"){
        $usuarioController->autenticarUsuario();
    }
}

if($requestMethod == "POST" && $requestUri == "/helpdesk/routes/api.php/chamado/criar"){
    $chamadoController->criarChamado();
}elseif($requestMethod == "GET" && $requestUri == "/helpdesk/routes/api.php/chamado/listar"){
    $chamadoController->listarChamados();
}elseif($requestMethod == "GET" &&  $requestUri == "/helpdesk/routes/api.php/chamado/atualizar-status"){
    $chamadoController->atualizarStatusChamado;
}

else{
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}

?>