<?php include("cabecalho.php"); 
include("conectaBD.php");
include("banco-categoria.php");

$categorias = listaCategorias($conexao);
?>


	<h1>Adicionar novo produto</h1>

	<form action="adiciona-produto.php" method="POST">
		<table class="table">
			
			<tr>
				<td>Nome</td>
				<td><input class="form-control" type="text" name="nome"/></td>
	        </tr>
	        
	        <tr>
	        	<td>Preço</td> 
	        	<td><input class="form-control" type="number" name="preco"/></td>
			</tr>

			<tr>
	        	<td>Descrição</td> 
	        	<td><textarea class="form-control" name="descricao"></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="checkbox" name="usado" value="true"> Usado</td>
			</tr>

			<tr>
				<td>Categoria</td>
				<td>
					<select class="custom-select" name="categoria_id">
					<?php foreach($categorias as $categoria) : ?>
						<option value="<?=$categoria['id']?>">
							<?=$categoria['nome']?>
						</option>
					<?php endforeach ?>
					</select>
				</td>
			</tr>

			<tr>
				<td></td>
				<td><input class="btn btn-primary" type="submit" value="Cadastrar" /></td>
			</tr>

		</table>
	</form>


<?php include("rodape.php"); ?>