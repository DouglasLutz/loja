<?php require_once("cabecalho.php");
	retornaEstranhoParaLogin();

	$vendaDao = new VendaDao($conexao);
	$venda = $vendaDao->getVenda($_POST['id']);
	$itens = $vendaDao->procedureProdutosVenda($_POST['id']);
?>

<h1>Compra número <?= $_POST['id'] ?></h1>

<h1>Itens na compra: </h1>
<table class="table table-striped text-center">
	<thead class="thead-dark">
		<tr>
			<th>Produto</th>
			<th>Quantidade</th>
			<th>Preco Unitário</th>
			<th>Total produto</th>
		</tr>
	</thead>
	
	<?php foreach($itens as $item): ?>

	<tr>
		<td><?=$item['produto']?></td>
		<td><?=$item['quantidade']?></td>
		<td><?=$item['valor_unitario']?></td>
		<td><?=$item['valor_total']?></td>
	</tr>

	<?php endforeach; ?>

	<thead class="thead-dark">
		<tr>
			<th></th>
			<th></th>
			<th>Subtotal</th>
			<th><?= $venda->calculaValorTotal() ?></th>
		</tr>
	</thead>
</table>

<?php require_once("rodape.php"); ?>