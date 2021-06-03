<?php

namespace Source\Model\Entity;

class Curso
{
    private $id;
    private $nome;
    private $ativo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     */
    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function dadosDoCurso(): array
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'ativo' => $this->getAtivo()
        ];
    }
}