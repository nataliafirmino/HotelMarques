<?php

class QuartoVO {
    
    private $id;
    private $numeroQuarto;
    private $tipo;
    private $capacidade;
    private $precoDiaria;
    private $status;
    private $descricao;
    
    public function getId() {
        return $this->id;
    }

    public function getNumeroQuarto() {
        return $this->numeroQuarto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCapacidade() {
        return $this->capacidade;
    }

    public function getPrecoDiaria() {
        return $this->precoDiaria;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumeroQuarto($numeroQuarto) {
        $this->numeroQuarto = $numeroQuarto;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setCapacidade($capacidade) {
        $this->capacidade = $capacidade;
    }

    public function setPrecoDiaria($precoDiaria) {
        $this->precoDiaria = $precoDiaria;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
   
}
?>