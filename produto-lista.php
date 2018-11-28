<?php 
	require_once("cabecalho.php");

	$produtoDao = new ProdutoDao($conexao);
	$produtos = $produtoDao->listaProdutos(); 
?>

<table class="table table-striped text-center">
	<thead class="thead-dark">
		<tr>
			<th>Nome</th>
			<th>Preco</th>
			<th>Descrição</th>
			<th>Categoria</th>
			
			<?php if(usuarioEstaLogado()): ?>
				<th>Adicionar ao carrinho</th>
			<?php endif; if(usuarioEhAdmin()) : ?>
				<th>Alterar</th>
				<th>Remover</th>
			<?php endif; ?>
		</tr>
	</thead>

	<?php foreach ($produtos as $produto) :	?>
	
	<tr>
		<td><?=$produto->getNome();?></td>
		<td><?=$produto->getPreco();?></td>
		<td>
			<?php 
			if(strlen($produto->getDescricao()) > 40)
				echo substr($produto->getDescricao(), 0, 40) . "...";
			else
				echo $produto->getDescricao();
			?>	
		</td>
		<td><?=$produto->categoria->getNome();?></td>
		<?php if(usuarioEstaLogado()): ?>
			<td>
				<form action="confirmacao-compra.php" method="POST">
					<input type="hidden" name="id" value="<?=$produto->getId()?>"/>
					<input class="btn btn-primary" type="submit" value="Adicionar"/>
				</form>
			</td>
		<?php endif; if(usuarioEhAdmin()): ?>
			<td>
				<form action="produto-altera-formulario.php" method="POST">
					<input type="hidden" name="id" value="<?=$produto->getId()?>"/>
					<input class="btn btn-warning" type="submit" value="Alterar"/>
				</form>
			<td>
				<form action="remove-produto.php" method="POST">
					<input type="hidden" name="id" value="<?=$produto->getId()?>"/>
					<input class="btn btn-danger" type="submit" value="Remover"/>
				</form>
			</td>

		<?php endif; ?>
	</tr>
	
	<?php endforeach; ?>

</table>

<?php require_once("rodape.php"); ?>