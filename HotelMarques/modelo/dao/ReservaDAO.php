<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/hotelMarques/modelo/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hotelMarques/modelo/vo/ReservaVO.php';

class ReservaDAO {

    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ReservaDAO();

        return self::$instance;
    }

    public function insert(ReservaVO $reserva) {
        try {
            $sql = "INSERT INTO reserva (dataEntrada,dataSaida,statusReserva,dataReserva, precoTotal, idCliente, idQuarto)"
                    . "VALUES "
                    . "(:dataEntrada,:dataSaida,:statusReserva,:dataReserva, :precoTotal, :idCliente, :idQuarto)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":dataEntrada", $reserva->getDataEntrada());
            $p_sql->bindValue(":dataSaida", $reserva->getDataSaida());
            $p_sql->bindValue(":statusReserva", $reserva->getStatusReserva());
            $p_sql->bindValue(":dataReserva", $reserva->getDataReserva());
            $p_sql->bindValue(":precoTotal", $reserva->getPrecoTotal());
            $p_sql->bindValue(":idCliente", $reserva->getIdCliente());
            $p_sql->bindValue(":idQuarto", $reserva->getIdQuarto());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update($reserva) {
        try {
            $sql = "UPDATE reserva SET dataEntrada=:dataEntrada, dataSaida=:dataSaida,"
                    . "statusReserva=:statusReserva, dataReserva=:dataReserva,"
                    . "precoTotal=:precoTotal, idCliente=:idCliente, idQuarto=:idQuarto"
                    . "where id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":dataEntrada", $reserva->getDataEntrada());
            $p_sql->bindValue(":dataSaida", $reserva->getDataSaida());
            $p_sql->bindValue(":statusReserva", ($reserva->getStatusReserva()));
            $p_sql->bindValue(":dataReserva", ($reserva->getDataReserva()));
            $p_sql->bindValue(":precoTotal", ($reserva->getPrecoTotal()));
            $p_sql->bindValue(":idCliente", ($reserva->getIdCliente()));
            $p_sql->bindValue(":idQuarto", ($reserva->getIdQuarto()));
            $p_sql->bindValue(":id", $reserva->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from reserva where id = :id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de deletar --" . $e->getMessage();
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM reserva WHERE id = :id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $this->converterLinhaDaBaseDeDadosParaObjeto($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    private function converterLinhaDaBaseDeDadosParaObjeto($row) {
        $obj = new Reserva();
        $obj->setId($row['id']);
        $obj->setDataEntrada($row['dataEntrada']);
        $obj->setDataSaida($row['dataSaida']);
        $obj->setStatusReserva($row['statusReserva']);
        $obj->setDataReserva($row['dataReserva']);
        $obj->setPrecoTotal($row['precoTotal']);
        $obj->setIdCliente($row['idCliente']);
        $obj->setIdQuarto($row['idQuarto']);

        
        
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM reserva ";
            $p_sql = BDPDO::getInstance()->prepare($sql);

            $p_sql->execute();

            $lista = array();
            $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $lista[] = $this->converterLinhaDaBaseDeDadosParaObjeto($row);
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return $lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
        }
    }

    public function listWhere($restanteDoSQL, $arrayDeParametros, $arrayDeValores) {
        try {
            $sql = "SELECT * FROM reserva " . $restanteDoSQL;
            $p_sql = BDPDO::getInstance()->prepare($sql);
            for ($i = 0; $i < sizeof($arrayDeParametros); $i++) {
                $p_sql->bindValue($arrayDeParametros[$i], $arrayDeValores [$i]);
            }
            $p_sql->execute();
            $lista = array();
            $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $lista[] = $this->converterLinhaDaBaseDeDadosParaObjeto($row);
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return $lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.".$e->getMessage();
        }
    }

}

?>