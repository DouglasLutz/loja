<?php 
require_once("cabecalho.php");
retornaEstranhoParaLogin();

$vendaDao = new VendaDao($conexao);
$id_venda = $vendaDao->getIdVendaAtiva($_SESSION['id_usuario']);

if($id_venda == 0){ // Não tem venda ativa, cria uma nova
	$id_venda = $vendaDao->criaNovaVenda($_SESSION['id_usuario']);
}

$itemVendaDao = new ItemVendaDao($conexao);

if($itemVendaDao->insereItemVenda($id_venda, $_POST['id'], $_POST['quantidade'])){
	?> <p class="text-success">Produto <?= $_POST['nome'] ?> adicionado ao carrinho com sucesso!</p> <?php
} else {
	$msg = mysqli_error($conexao);
	?> <p class="text-danger">Produto não foi adicionado ao carrinho: Erro(<?= $msg ?>), contate o suporte ou tente novamente! </p> <?php
}

?>

<a href="produto-lista.php" class="btn btn-primary">Continuar comprando</a>
<a href="carrinho.php" class="btn btn-primary">Ir para o carrinho</a>

<?php require_once("rodape.php"); ?>