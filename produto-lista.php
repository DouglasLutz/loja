<?php 
	require_once("cabecalho.php"); 
	require_once("banco-produto.php");

	require_once("class/Produto.php");
	require_once("class/Categoria.php");

	$produtos = listaProdutos($conexao); 
?>

<table class="table table-bordered table-striped text-center">
	<thead class="thead-dark">
		<tr>
			<th>Nome</th>
			<th>Preco</th>
			<th>Preco com desconto</th>
			<th>Descrição</th>
			<th>Categoria</th>
			<th>Alterar</th>
			<th>Remover</th>
		</tr>
	</thead>

	<?php foreach ($produtos as $produto) :	?>
	
	<tr>
		<td><?=$produto->getNome();?></td>
		<td><?=$produto->getPreco();?></td>
		<td><?=$produto->precoComDesconto(0.2)?></td>
		<td>
			<?php 
			if(strlen($produto->getDescricao()) > 40)
				echo substr($produto->getDescricao(), 0, 40) . "...";
			else
				echo $produto->getDescricao();
			?>	
		</td>
		<td><?=$produto->categoria->getNome();?></td>
		<td>
			<form action="produto-altera-formulario.php" method="POST">
				<input type="hidden" name="id" value="<?=$produto->getId()?>"/>
				<input class="btn btn-primary" type="submit" value="O"/>
			</form>
		<td>
			<form action="remove-produto.php" method="POST">
				<input type="hidden" name="id" value="<?=$produto->getId()?>"/>
				<input class="btn btn-outline-danger" type="submit" value="X"/>
			</form>
		</td>
	</tr>
	
	<?php endforeach; ?>

</table>

<?php require_once("rodape.php"); ?>