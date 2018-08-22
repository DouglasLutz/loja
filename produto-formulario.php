<?php 
	require_once("cabecalho.php"); 
	require_once("banco-categoria.php");
	require_once("logica-usuario.php");

	require_once("class/Produto.php");
  	require_once("class/Categoria.php");

	retornaEstranhoParaLogin();

	$categorias = listaCategorias($conexao);

	//Inicializar os valores das variaveis para criar os campos da tabela vazios
	$produto = new Produto();

	$produto->setNome("");
	$produto->setPreco("");
	$produto->setDescricao("");
	$produto->categoria->setId(1);
	$produto->setUsado("");
	$usado = "";
?>

<h1>Adicionar novo produto</h1>

<form action="adiciona-produto.php" method="POST">
	<table class="table">
		
		<?php require_once("campos-tabela-formulario.php") ?>

		<tr>
			<td></td>
			<td><input class="btn btn-primary" type="submit" value="Cadastrar" /></td>
		</tr>

	</table>
</form>

<?php require_once("rodape.php"); ?>