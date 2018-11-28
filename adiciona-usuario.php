<?php 
	session_start();
	require_once("conectaBD.php");
	require_once("auto-register.php");

	$usuario = new Usuario($_POST['email'], $_POST['senha']);
	$usuarioDao = new UsuarioDao($conexao);

	if($usuarioDao->insereUsuario($usuario)){
		$_SESSION["success"] = "Usuario criado com sucesso";
	} else {
		$msg = mysqli_error($conexao);
		$_SESSION["danger"] = "Erro ao cadastrar usuario, tente novamente (Erro {$msg})";
	}

	header("Location: index.php");
	die();
?>