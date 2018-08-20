<?php include("cabecalho.php"); ?>
	

	<h1>Bem vindo!</h1>

	<div class="container dark">
		<h2>Login</h2>

		<form action="login.php" method="POST">
			<table class="table table-striped table-dark">
				<tr>
					<td>Email</td>
					<td><input class="form-control" type="email" name="email"/></td>
				</tr>
				<tr>
					<td>Senha</td>
					<td><input class="form-control" type="password" name="senha"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input class="btn btn-primary form-control" type="submit" value="Logar"></td>
				</tr>


			</table>
		</form>
	</div>


<?php include("rodape.php"); ?>