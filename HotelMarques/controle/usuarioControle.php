<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/HotelMarques/modelo/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/HotelMarques/modelo/dao/UsuarioDAO.php';

$objUsuario = new UsuarioVO();
$objUsuario ->setCpf($_POST['cpf']);
$objUsuario ->setEmail($_POST['email']);
$objUsuario ->setNome($_POST['nome']);
$objUsuario ->setSenha($_POST['senha']);
$objUsuario ->setStatusUsuario($_POST['statusUsuario']);

UsuarioDAO::getInstance()->insert($objUsuario);
echo "<script> 
    alert ('Salvo com sucesso!');
    window.location.href='../usuarioListar.php';
    </script>";
?>    

