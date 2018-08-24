<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once("logica-usuario.php");
retornaEstranhoParaLogin();

require_once("cabecalho.php");

$produtoDao = new ProdutoDao($conexao);
$produtoDao->removeProduto($_POST['id']);

$_SESSION["success"] = "Produto removido com sucesso";
header("Location: produto-lista.php");
die();
?>