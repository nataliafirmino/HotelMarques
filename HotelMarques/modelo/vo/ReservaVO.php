<?php
class Reserva {
    private $id;
    private $dataEntrada;
    private $dataSaida;
    private $preco;
    private $idQuarto;
    private $idCliente;
    
    public function getId() {
        return $this->id;
    }

    public function getDataEntrada() {
        return $this->dataEntrada;
    }

    public function getDataSaida() {
        return $this->dataSaida;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getIdQuarto() {
        return $this->idQuarto;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDataEntrada($dataEntrada) {
        $this->dataEntrada = $dataEntrada;
    }

    public function setDataSaida($dataSaida) {
        $this->dataSaida = $dataSaida;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setIdQuarto($idQuarto) {
        $this->idQuarto = $idQuarto;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }


}
?>