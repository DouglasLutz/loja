<?php 
	require_once("cabecalho.php");
	retornaEstranhoParaLogin();

	$vendaDao = new VendaDao($conexao);
	$id_venda = $vendaDao->getIdVendaAtiva($_SESSION['id_usuario']);

	if($id_venda == 0){ // Não tem venda ativa, cria uma nova
		$id_venda = $vendaDao->criaNovaVenda($_SESSION['id_usuario']);
	}

	$venda = $vendaDao->getVenda($id_venda);


?>
	<h1>Carrinho número <?= $id_venda ?>: </h1>

	<?php if(count($venda->itens) == 0 ): ?>
		<div class="container" style="padding: 50px">
			<h2> Poxa, seu carrinho esta vazio :( </h2><br>
			<a href="produto-lista.php" class="btn btn-primary">Produtos à venda</a>
		</div>
	<?php else: ?>
		<table class="table table-striped text-center">
			<thead class="thead-dark">
				<tr>
					<th>Produto</th>
					<th>Quantidade</th>
					<th>Preco Unitário</th>
					<th>Total produto</th>
					<th>Remover do Carrinho</th>
				</tr>
			</thead>
			
			<?php foreach($venda->itens as $item): ?>
			<tr>
				<td><?=$item->produto->getNome()?></td>
				<td><?=$item->quantidade?></td>
				<td><?=$item->produto->getPreco()?></td>
				<td><?=$item->getPrecoTotal()?></td>
				<td>
					<form action="remove-produto-carrinho.php" method="POST">
						<input type="hidden" name="id" value="<?=$item->produto->getId()?>"/>
						<input class="btn btn-danger" type="submit" value="Remover"/>
					</form>
				</td>
			</tr>

			<?php endforeach; ?>

			<thead class="thead-dark">
				<tr>
					<th></th>
					<th></th>
					<th>Subtotal</th>
					<th><?=$venda->calculaValorTotal()?></th>
					<th>
						<a href="finalizar-compra.php" class="btn btn-primary">Finalizar compra</a>
					</th>
				</tr>
			</thead>
		</table>
	<?php endif; ?>


<?php
	require_once("rodape.php");
?>