<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/hotelMarques/modelo/dao/BDPDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hotelMarques/modelo/vo/ClienteVO.php';

class ClienteDAO {

    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ClienteDAO();

        return self::$instance;
    }

    public function insert(ClienteVO $cliente) {
        try {
            $sql = "INSERT INTO cliente (nome,cpf,telefone,Email,endereco)"
                    . "VALUES "
                    . "(:nome,:cpf,:telefone,:Email,:endereco)";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":cpf", $cliente->getCpf());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
            $p_sql->bindValue(":Email", $cliente->getPrecoDiaria());
            $p_sql->bindValue(":endereco", $cliente->getEndereco());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }

    public function update($cliente) {
        try {
            $sql = "UPDATE cliente SET nome=:nome, telefone=:telefone,"
                    . "cpf=:cpf, Email=:Email, endereco=:endereco"
                    . "where id=:id";
            //perceba que na linha abaixo vai precisar de um import
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":cpf", $cliente->getCpf());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
            $p_sql->bindValue(":Email", ($cliente->getPrecoDiaria()));
            $p_sql->bindValue(":endereco", ($cliente->getEndereco()));
            $p_sql->bindValue(":id", $cliente->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao executar a função de atualizar" . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "delete from cliente where id = :id";
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
            $sql = "SELECT * FROM cliente WHERE id = :id";
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
        $obj = new Cliente();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setCpf($row['cpf']);
        $obj->setTelefone($row['telefone']);
        $obj->setPrecoDiaria($row['Email']);
        $obj->setEndereco($row['endereco']);
        
        return $obj;
    }

    public function listAll() {
        try {
            $sql = "SELECT * FROM cliente ";
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
            $sql = "SELECT * FROM cliente " . $restanteDoSQL;
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