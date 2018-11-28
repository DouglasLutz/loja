<?php 
require_once("cabecalho.php");
retornaEstranhoParaLogin();

$vendaDao = new VendaDao($conexao);
$id_venda = $vendaDao->getIdVendaAtiva($_SESSION['id_usuario']);

$itemVendaDao = new ItemVendaDao($conexao);


if($itemVendaDao->removeItemVenda($id_venda, $_POST['id'])){
	$_SESSION["success"] = "Produto removido com sucesso";
} else {
	$msg = mysqli_error($conexao);
    $_SESSION["danger"] = "Erro ao remover produto, tente novamente (Erro {$msg})";
}

header("Location: carrinho.php");
die();