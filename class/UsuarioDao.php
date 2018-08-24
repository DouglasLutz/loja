<?php

class UsuarioDao {
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function insereUsuario($usuario){
		$email = mysqli_real_escape_string($this->conexao, $usuario->getEmail());

		$query = "insert into usuarios (email, senha) values ('{$email}', '{$usuario->getSenhaMd5()}')";
		return mysqli_query($this->conexao, $query);
	}

	function buscaUsuario($usuario){
		$email = mysqli_real_escape_string($this->conexao, $usuario->getEmail());
		$query = "select email, senha from usuarios where email='{$email}' and senha='{$usuario->getSenhaMd5()}'";

		$resultado = mysqli_query($this->conexao, $query);

		return mysqli_fetch_assoc($resultado);
	}

}