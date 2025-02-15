<?php   

header("Content-type: application/json");
require_once __DIR__ . '/../controllers/Usuariocontroller.php';

$usuarioController = new UsuarioController();

$requestUri = explode("?", $_SERVER["REQUEST_URI"], 2)[0];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($requestUri == "/helpdesk/routes/api.php/usuario/criar"){
        $usuarioController->criarUsuario();
    }elseif($requestUri == "/helpdesk/routes/api.php/usuario/login"){
        $usuarioController->autenticarUsuario();
    }else{
        http_response_code(404);
        echo json_encode(["erro" => "Rota não encontrada"]);
    }
}else{
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
}
?>