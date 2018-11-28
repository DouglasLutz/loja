<?php 
	require_once("cabecalho.php");
	retornaEstranhoParaLogin();

	$vendaDao = new VendaDao($conexao);
	$vendas = $vendaDao->getVendasCliente($_SESSION['id_usuario']);
?>

<a href="formulario-altera-senha.php" class="btn btn-warning form-control">Alterar senha da conta</a>

<h1>Compras efetuadas</h1>

<table class="table table-striped text-center">
	<thead class="thead-dark">
		<tr>
			<th>Número da compra</th>
			<th>Valor total</th>
			<th>Detalhes</th>
		</tr>
	</thead>

	<?php foreach($vendas as $venda): ?>
		<tr>
			<td><?= $venda['id'] ?></td>
			<td><?= $venda['valor_total'] ?></td>
			<td>
				<form action="detalhe-venda.php" method="POST">
					<input type="hidden" name="id" value="<?=$venda['id']?>">
					<input class="btn btn-info" type="submit" name="Ver" value="Ver">
				</form>
			</td>
		</tr>


	<?php endforeach;?>
</table>

<?php
	require_once("rodape.php");
?>