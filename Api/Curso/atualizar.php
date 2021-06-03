<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../../source/autoload.php';

// Pega os dados do post
$dadosRecebido = json_decode(file_get_contents("php://input"), false);

if (empty($dadosRecebido->id)) {
    // codigo não encontrado
    http_response_code(400);
    echo json_encode(["mensagem" => "Não foi possivel atualizar o Curso."]);
} else {
    $cursoDao = new \Source\Model\Dao\CursoDao();

    $cursoRetornado = $cursoDao->obtemCursosPeloId($dadosRecebido->id);

    if (!empty($cursoRetornado)) {
        $curso = new \Source\Model\Entity\Curso();

        $id = $cursoRetornado->getId();
        $nome = $dadosRecebido->nome ?? $cursoRetornado->getNome();
        $ativo = $dadosRecebido->ativo ?? $cursoRetornado->getAtivo();

        $curso->setId($id);
        $curso->setNome($nome);
        $curso->setAtivo($ativo);

        if ($cursoDao->atualizarCurso($curso))  {
            // Retorno de criado com sucesso
            http_response_code(200);
            echo json_encode(["mensagem" => "Curso atualizado com sucesso."]);
        } else {
            // Retorno para serviço indisponivel
            http_response_code(503);
            echo json_encode(["mensagem" => "Não foi possivel atualizar o Curso."]);
        }
    } else {
        // codigo não encontrado
        http_response_code(400);
        echo json_encode(["mensagem" => "Não foi possivel atualizar o Curso."]);
    }
}
