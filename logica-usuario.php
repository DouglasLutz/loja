<?php
session_start();

function usuarioEstaLogado(){
	return isset($_SESSION["usuario_logado"]);
}

function usuarioEhAdmin(){
	return $_SESSION["admin"] == "1";
}

function retornaEstranhoParaLogin(){
	if(!usuarioEstaLogado()){
		$_SESSION["danger"] = "Você não tem acesso a esta funcionalidade";
		header("Location: index.php");
		die();
	}
}

function retornaClienteParaHome(){
	if(!usuarioEhAdmin()){
		$_SESSION["danger"] = "Você não tem acesso a esta funcionalidade";
		header("Location: index.php");
		die();
	}
}


function usuarioLogado(){
	return $_SESSION["usuario_logado"];
}

function logaUsuario($id, $email, $admin){
	$_SESSION["success"] = "Usuario logado com sucesso";
	$_SESSION["usuario_logado"] = $email;
	$_SESSION["id_usuario"] = $id;

	if($admin){
		$_SESSION["admin"] = "1";
	}
}

function logout(){
	unset($_SESSION["usuario_logado"]);
	unset($_SESSION["id_usuario"]);
	unset($_SESSION["admin"]);
	//session_destroy();
	//session_start();
	$_SESSION["success"] = "Usuario deslogado com sucesso";
}