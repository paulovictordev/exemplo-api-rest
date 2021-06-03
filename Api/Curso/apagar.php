<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../source/autoload.php';

// Pega os dados do post
$dadosRecebido = json_decode(file_get_contents("php://input"), false);

if (empty($dadosRecebido->id)) {
    // codigo não encontrado
    http_response_code(400);
    echo json_encode(["mensagem" => "Não foi possivel encontrar o Curso."]);
} else {
    $curso = new \Source\Model\Entity\Curso();
    $cursoDao = new \Source\Model\Dao\CursoDao();

    $curso->setId($dadosRecebido->id);

    if ($cursoDao->deletarCurso($curso))  {
        // Retorno de criado com sucesso
        http_response_code(200);
        echo json_encode(["mensagem" => "Curso apagado com sucesso."]);
    } else {
        // Retorno para serviço indisponivel
        http_response_code(503);
        echo json_encode(["mensagem" => "Não foi possivel apagar o Curso."]);
    }
}
