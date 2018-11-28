<?php 
	require_once("cabecalho.php");
	retornaEstranhoParaLogin();

	$produtoDao = new ProdutoDao($conexao);
	$produto = $produtoDao->buscaProduto($_POST['id']);
?>

<h1>Deseja adicionar <?= $produto->getNome() ?> ao seu carrinho? </h1>

<p><?=$produto->getDescricao()?></p>
<?php if($produto->getUsado()): ?>
	<p>O produto é usado.</p>
<?php endif; ?>

<form method="POST" action="adiciona-produto-carrinho.php">
	<label class="" for="quantidade">Quantidade: </label>
	<input class="form-control" type="number" name="quantidade" placeholder="Ex: 5">
	<input type="hidden" name="id" value="<?= $produto->getId() ?>">
	<input type="hidden" name="nome" value="<?= $produto->getNome() ?>">
	<input class="form-control btn btn-primary" type="submit" name="Adicionar" value="Adicionar">
</form>


<?php require_once("rodape.php"); ?>