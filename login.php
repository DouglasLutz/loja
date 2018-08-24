<?php 
require_once("cabecalho.php");
require_once("logica-usuario.php");

$usuarioDao = new UsuarioDao($conexao);
$usuario = new Usuario($_POST['email'], $_POST['senha']);


if($usuarioDao->buscaUsuario($usuario)){
	logaUsuario($usuario->getEmail());
	header("Location: index.php");
} else {
	$_SESSION["danger"] = "Usuário ou senha inválido";
	header("Location: index.php");
}

die();