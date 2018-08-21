<?php 
require_once("cabecalho.php"); 
require_once("logica-usuario.php");
?>

<h1>Bem vindo!</h1>

<?php if(usuarioEstaLogado()) {?>
	<p class="text-success">Você está logado como <?=usuarioLogado()?></p>
	<a href="logout.php" class="btn btn-primary">Logout</a>
<?php } ?>

<?php if(!usuarioEstaLogado()) {?>
<div class="container text-light bg-dark w-50 p-2">
	<h2>Login</h2>

	<form action="login.php" method="POST">
		<table class="table text-light">
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
				<td><input class="btn btn-primary form-control" type="submit" value="Logar"></td>
			</tr>
		</table>
	</form>
</div>
<?php } ?>

<?php require_once("rodape.php"); ?>