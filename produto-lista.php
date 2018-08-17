<?php 
include("cabecalho.php"); 
include("conectaBD.php"); 
include("banco-produto.php");

if(array_key_exists("removido", $_GET) && $_GET["removido"]=="true"){
?>
	<p class="alert-success">Produto apagado com sucesso.</p>
<?php
}

 $produtos = listaProdutos($conexao); ?>

<table class="table table-bordered table-striped text-center">
	<thead class="thead-dark">
		<tr>
			<th>Nome</th>
			<th>Preco</th>
			<th>Descrição</th>
			<th>Categoria</th>
			<th>Alterar</th>
			<th>Remover</th>
		</tr>
	</thead>

	<?php foreach ($produtos as $produto) :	?>
	
	<tr>
		<td><?=$produto['nome'];?></td>
		<td><?=$produto['preco'];?></td>
		<td>
			<?php 
			if(strlen($produto['descricao']) > 40)
				echo substr($produto['descricao'], 0, 40) . "...";
			else
				echo $produto['descricao'];
			?>	
		</td>
		<td><?=$produto['nome_categoria'];?></td>
		<td>
			<form action="produto-altera-formulario.php" method="POST">
				<input type="hidden" name="id" value="<?=$produto['id']?>"/>
				<input class="btn btn-primary" type="submit" value="O"/>
			</form>
		<td>
			<form action="remove-produto.php" method="POST">
				<input type="hidden" name="id" value="<?=$produto['id']?>"/>
				<input class="btn btn-outline-danger" type="submit" value="X"/>
			</form>
		</td>
	</tr>
	
	<?php endforeach; ?>

</table>

<?php include("rodape.php"); ?>