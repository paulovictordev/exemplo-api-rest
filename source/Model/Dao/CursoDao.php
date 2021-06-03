<?php

namespace Source\Model\Dao;

use PDO;
use Source\Database\Conexao;
use Source\Model\Entity\Curso;

class CursoDao
{
    const TABELA = 'cursos';

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance();
    }

    public function obtemCursos(): array
    {
        $query = "SELECT * FROM " . self::TABELA;

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        $registrosEncontrados = $stmt->rowCount();

        if($registrosEncontrados > 0) {
            $cursos = [];

            while ($row = $stmt->fetch(PDO::FETCH_OBJ))  {
//                $curso = new Curso();
//
//                $curso->setId($row->id);
//                $curso->setNome($row->nome);
//                $curso->setAtivo($row->ativo);

                $curso['Id'] = $row->id;
                $curso['nome'] = $row->nome;
                $curso['ativo'] = $row->ativo;

                array_push($cursos,  $curso);
            }

            return $cursos;
        }

        return [];
    }

    public function obtemCursosPeloId(int $id): Curso
    {
        $query = "SELECT * FROM " . self::TABELA . " WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        // Evita encode não reconhecido (<, &, ect)
        $id = htmlspecialchars(strip_tags($id));

        // bind de valores
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $curso = new Curso();
        if (isset($row->id)) {
            $curso->setId($row->id);
            $curso->setNome($row->nome);
            $curso->setAtivo($row->ativo);
        }

        return $curso;
    }

    public function inserirCurso(Curso $curso): bool
    {
        $query = "INSERT INTO " . self::TABELA . " (nome, ativo) VALUES (:nome, :ativo)";

        $stmt = $this->conexao->prepare($query);

        // Evita encode não reconhecido (<, &, ect)
        $curso->setNome(htmlspecialchars(strip_tags($curso->getNome())));
        $curso->setAtivo(htmlspecialchars(strip_tags($curso->getAtivo())));

        // bind de valores
        $stmt->bindValue(":nome", $curso->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(":ativo", $curso->getAtivo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function atualizarCurso(Curso $curso): bool
    {
        $query = "UPDATE " . self::TABELA . " SET nome = :nome, ativo = :ativo WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        // Evita encode não reconhecido (<, &, ect)
        $curso->setId(htmlspecialchars(strip_tags($curso->getId())));
        $curso->setNome(htmlspecialchars(strip_tags($curso->getNome())));
        $curso->setAtivo(htmlspecialchars(strip_tags($curso->getAtivo())));

        // bind de valores
        $stmt->bindValue(":id", $curso->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":nome", $curso->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(":ativo", $curso->getAtivo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deletarCurso(Curso $curso): bool
    {
        $query = "DELETE FROM " . self::TABELA . " WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        // Evita encode não reconhecido (<, &, ect)
        $curso->setId(htmlspecialchars(strip_tags($curso->getId())));

        // bind de valores
        $stmt->bindValue(":id", $curso->getId(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}