<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../source/autoload.php';

$cursoDao = new \Source\Model\Dao\CursoDao();

$cursos = $cursoDao->obtemCursos();

if (!empty($cursos)) {
    // codigo de sucesso
    http_response_code(200);
    echo json_encode($cursos);
} else {
    // codigo não encontrado
    http_response_code(404);
    echo json_encode(["mensagem" => "Nenhuma Categoria foi encontrada. "]);
}
