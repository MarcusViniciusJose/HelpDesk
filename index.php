<?php
require_once __DIR__ . '/routes/api.php';

require_once __DIR__ . '/../controllers/ChamadoController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && $requestUri == "/api/chamado/criar") {
    $chamadoController->criarChamado();
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $requestUri == "/api/chamado/listar") {
    $chamadoController->listarChamados();
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && preg_match("/\/api\/chamado\/(\d+)/", $requestUri, $matches)) {
    $chamadoController->buscarChamadoPorId($matches[1]);
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT" && $requestUri == "/api/chamado/atualizar-status") {
    $chamadoController->atualizarStatusChamado();
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && preg_match("/\/api\/chamado\/deletar\/(\d+)/", $requestUri, $matches)) {
    $chamadoController->deletarChamado($matches[1]);
} else {
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}

?>