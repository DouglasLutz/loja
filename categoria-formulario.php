<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once("logica-usuario.php");
	retornaClienteParaHome();

	require_once("cabecalho.php"); 
?>

<h1>Adicionar nova categoria</h1>

<form action="adiciona-categoria.php" method="POST">
	<table class="table">
		<tr>
		    <td>Nome</td>
		    <td><input class="form-control" type="text" name="nome" /></td>
		</tr>

		<tr>
			<td></td>
			<td><input class="btn btn-primary" type="submit" value="Cadastrar" /></td>
		</tr>
	</table>
</form>

<?php require_once("rodape.php"); ?>