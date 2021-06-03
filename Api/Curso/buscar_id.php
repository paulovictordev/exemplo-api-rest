<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once __DIR__ . '/../../source/autoload.php';
$id  = isset($_GET['id']) ? $_GET['id'] : null;

if (!empty($id)) {
    $cursoDao = new \Source\Model\Dao\CursoDao();
    $curso = $cursoDao->obtemCursosPeloId($id);

    if (!empty($curso)) {
        // codigo de sucesso
        http_response_code(200);
        echo json_encode($curso->dadosDoCurso());
    } else {
        // codigo não encontrado
        http_response_code(404);
        echo json_encode(["mensagem" => "Nenhum Curso foi encontrado."]);
    }
} else {
    // codigo não encontrado
    http_response_code(400);
    echo json_encode(["mensagem" => "Não foi possivel encontrar o Curso.."]);
}


