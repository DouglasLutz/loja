<?php require_once("cabecalho.php"); ?>

<h1>Cadastrar novo usuário</h1>
<form onSubmit="validate();" action="adiciona-usuario.php" method="POST">
	<table class="table table-striped">
		<tr>
			<td>Email:</td>
			<td><input class="form-control" type="email" name="email" required="true"></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input class="form-control" type="password" name="senha" required="true"></td>
		</tr>
		<tr>
			<td>Repetir senha:</td>
			<td><input class="form-control" type="password" name="senha_confirmacao" required="true"></td>
		</tr>
		<tr>
			<td></td>
			<td><input class="btn btn-primary form-control" type="submit" name="Enviar"></td>
		</tr>
	</table>
</form>

<?php require_once("rodape.php"); ?>