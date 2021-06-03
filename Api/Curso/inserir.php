<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../source/autoload.php';

// Pega os dados do post
$dadosRecebido = json_decode(file_get_contents("php://input"), false);

if (empty($dadosRecebido->nome) && empty($dadosRecebido->ativo)) {
    // codigo não encontrado
    http_response_code(400);
    echo json_encode(["mensagem" => "Não foi possivel criar o Curso, existe dados incompletos."]);
} else {
    $curso = new \Source\Model\Entity\Curso();
    $cursoDao = new \Source\Model\Dao\CursoDao();

    $curso->setNome($dadosRecebido->nome);
    $curso->setAtivo($dadosRecebido->ativo);

    if ($cursoDao->inserirCurso($curso))  {
        // Retorno de criado com sucesso
        http_response_code(201);
        echo json_encode(["mensagem" => "Curso criado com sucesso."]);
    } else {
        // Retorno para serviço indisponivel
        http_response_code(503);
        echo json_encode(["mensagem" => "Não foi possivel salvar o Curso."]);
    }
}
