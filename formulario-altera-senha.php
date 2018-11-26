<?php 
    require_once("cabecalho.php");
    require_once("logica-usuario.php");

    retornaEstranhoParaLogin();
?>

<p class="alert-danger" id="mensagem-erro"></p>

<form id="form-alterar-senha" action="altera-senha.php" method="POST">
	<table class="table table-striped">
		<tr>
			<td>Senha atual:</td>
			<td><input class="form-control" type="password" name="senha_antiga" placeholder="Digite sua senha atual" required="true"></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input class="form-control" type="password" name="senha_nova" placeholder="Digite a nova senha" required="true"></td>
		</tr>
		<tr>
			<td>Repetir senha:</td>
			<td><input class="form-control" type="password" name="senha_confirmacao" placeholder="Repita a nova senha" required="true"></td>
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
		var form = document.querySelector("#form-alterar-senha");

		var senha1 = form.senha_nova.value;
		var senha2 = form.senha_confirmacao.value;

		if (senha1 !== senha2) {
			event.preventDefault();

			var mensagemErro = document.querySelector("#mensagem-erro");
			mensagemErro.textContent = "As senhas não conferem";

            form.senha_antiga.value = "";
			form.senha_nova.value = "";
			form.senha_confirmacao.value = "";

			return;
		}
	});
</script>

<? require_once("rodape.php"); ?>