<?php 
require_once("cabecalho.php"); 
require_once("logica-usuario.php");
?>

<h1>Bem vindo!</h1>

<?php if(!usuarioEstaLogado()) {?>
<div class="container text-light bg-dark w-50 p-2">
	<h2>Login</h2>

	
	<table class="table text-light">
		<form action="login.php" method="POST">
			<tr>
				<td>Email</td>
				<td><input class="form-control" type="email" name="email" required="true"/></td>
			</tr>
			<tr>
				<td>Senha</td>
				<td><input class="form-control" type="password" name="senha" required="true"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn btn-primary form-control" type="submit" value="Logar"/></td>
			</tr>
		</form>
		<form action="formulario-usuario.php" method="POST">
			<tr>
				<td><p>Não é usuário?</p></td>
				<td><input class="btn btn-secondary form-control" type="submit" value="Criar nova conta"/></td>
			</tr>
		</form>
	</table>
	
</div>
<?php } ?>

<?php require_once("rodape.php"); ?>