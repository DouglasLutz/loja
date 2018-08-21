<?php
session_start();

function usuarioEstaLogado(){
	return isset($_SESSION["usuario_logado"]);
}

function retornaEstranhoParaLogin(){
	if(!usuarioEstaLogado()){
		$_SESSION["danger"] = "Você não tem acesso a esta funcionalidade";
		header("Location: index.php");
		die();
	}
}

function usuarioLogado(){
	return $_SESSION["usuario_logado"];
}

function logaUsuario($email){
	$_SESSION["success"] = "Usuario logado com sucesso";
	$_SESSION["usuario_logado"] = $email;
}

function logout(){
	unset($_SESSION["usuario_logado"]);
	//session_destroy();
	//session_start();
	$_SESSION["success"] = "Usuario deslogado com sucesso";
}