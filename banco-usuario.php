<?php
require_once("conectaBD.php");

function buscaUsuario($conexao, $email, $senha){
	$senhaMd5 = md5($senha);
	$email = mysqli_real_escape_string($conexao, $email);
	$query = "select email, senha from usuarios where email='{$email}' and senha='{$senhaMd5}'";

	$resultado = mysqli_query($conexao, $query);

	return mysqli_fetch_assoc($resultado);
}