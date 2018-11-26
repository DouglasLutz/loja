<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	require_once("logica-usuario.php");
	retornaClienteParaHome();
	
	require_once("cabecalho.php"); 

	$categoriaDao = new CategoriaDao($conexao);
	$categorias = $categoriaDao->listaCategorias();

	//Inicializar os valores das variaveis para criar os campos da tabela vazios
	$produto = new Produto("", "", "");
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