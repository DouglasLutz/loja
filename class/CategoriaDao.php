<?php

class CategoriaDao {
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}


	function listaCategorias() {
		$categorias = array();

		$query = "select id, nome from categorias";
		$resultado = mysqli_query($this->conexao, $query);

		while ($categoria_array = mysqli_fetch_assoc($resultado)) {
			$categoria = new Categoria();

			$categoria->setId($categoria_array['id']);
			$categoria->setNome($categoria_array['nome']);

			array_push($categorias, $categoria);
		}

		return $categorias;
	}

	function insereCategoria(Categoria $categoria) {
		$nome = mysqli_real_escape_string($this->conexao, $categoria->getNome());

	    $query = "insert into categorias (nome) value ('{$nome}')";

	    $resultadoDaInsercao = mysqli_query($this->conexao, $query);
	    return $resultadoDaInsercao;
	}
}