<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once("logica-usuario.php");
retornaEstranhoParaLogin();

require_once("cabecalho.php");

$produtoDao = new ProdutoDao($conexao);

if($produtoDao->removeProduto($_POST['id'])){
	$_SESSION["success"] = "Produto removido com sucesso";
} else {
	$msg = mysqli_error($conexao);
    $_SESSION["danger"] = "Erro ao remover produto, tente novamente (Erro {$msg})";
}

header("Location: produto-lista.php");
die();
?>