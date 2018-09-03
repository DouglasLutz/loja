<?php require_once("cabecalho.php"); ?>

<p class="alert-danger" id="mensagem-erro"></p>

<h1>Cadastrar novo usuário</h1>
<form id="form-adiciona" action="adiciona-usuario.php" method="POST">
	<table class="table table-striped">
		<tr>
			<td>Email:</td>
			<td><input class="form-control" type="email" name="email" placeholder="Digite seu email" required="true"></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input class="form-control" type="password" name="senha" placeholder="Digite sua senha" required="true"></td>
		</tr>
		<tr>
			<td>Repetir senha:</td>
			<td><input class="form-control" type="password" name="senha_confirmacao" placeholder="Repita a senha" required="true"></td>
		</tr>
		<tr>
			<td></td>
			<td><input id="botao-enviar" class="btn btn-primary form-control" type="submit" name="Enviar"></td>
		</tr>
	</table>
</form>

<script>
	var botao = document.querySelector("#botao-enviar");

	botao.addEventListener("click", function(event){
		var form = document.querySelector("#form-adiciona");

		var senha1 = form.senha.value;
		var senha2 = form.senha_confirmacao.value;

		if (senha1 !== senha2) {
			event.preventDefault();

			var mensagemErro = document.querySelector("#mensagem-erro");
			mensagemErro.textContent = "As senhas não conferem";

			form.senha.value = "";
			form.senha_confirmacao.value = "";

			return;
		}
	});
</script>

<?php require_once("rodape.php"); ?>