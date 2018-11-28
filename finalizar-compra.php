<?php 
require_once("cabecalho.php");
retornaEstranhoParaLogin();

$vendaDao = new VendaDao($conexao);
$id_venda = $vendaDao->getIdVendaAtiva($_SESSION['id_usuario']);

if($vendaDao->finalizaVenda($id_venda)){
	?><h1>Venda finalizada com sucesso!!</h1><?php
} else {
	?><h1>Ops, algo deu errado!!</h1><?php
}

?>