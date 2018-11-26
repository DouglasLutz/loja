<?php 
require_once("auto-register.php");
require_once("conectaBD.php");
require_once("logica-usuario.php");

$usuarioDao = new UsuarioDao($conexao);
$usuario = new Usuario($_POST['email'], $_POST['senha']);

$usuarioLogado = $usuarioDao->buscaUsuario($usuario);

if($usuarioLogado){
	logaUsuario($usuarioLogado['id'], $usuarioLogado['email'], $usuarioLogado['eh_admin']);
	header("Location: index.php");
} else {
	$_SESSION["danger"] = "Usuário ou senha inválido";
	header("Location: index.php");
}

die();