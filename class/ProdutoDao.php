<?php

class ProdutoDao {
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function listaProdutos(){
		$produtos = array();
		$resultadoPesquisa = mysqli_query($this->conexao, "select p.id as id, p.nome as nome, p.preco as preco, p.descricao as descricao, c.nome as nome_categoria 
													from produtos p 
													inner join categorias c on c.id = p.id_categoria");

		while($produto_array = mysqli_fetch_assoc($resultadoPesquisa)){
			$produto = new Produto($produto_array['nome'], $produto_array['preco'], $produto_array['descricao']);
			$produto->setId($produto_array['id']);
			$produto->categoria->setNome($produto_array['nome_categoria']);

			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function insereProduto(Produto $produto) {
		$nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$preco = mysqli_real_escape_string($this->conexao, $produto->getPreco());
		$descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$id_categoria = mysqli_real_escape_string($this->conexao, $produto->categoria->getId());
		$usado = mysqli_real_escape_string($this->conexao, $produto->getUsado());

	    $query = "insert into produtos (nome, preco, descricao, id_categoria, usado) values 
	    			('{$nome}', '{$preco}', '{$descricao}', '{$id_categoria}', '{$usado}')";

	    $resultadoDaInsercao = mysqli_query($this->conexao, $query);
	    return $resultadoDaInsercao;
	}

	function alteraProduto(Produto $produto) {
		$nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$preco = mysqli_real_escape_string($this->conexao, $produto->getPreco());
		$descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$id_categoria = mysqli_real_escape_string($this->conexao, $produto->categoria->getId());
		$usado = mysqli_real_escape_string($this->conexao, $produto->getUsado());
		$id = mysqli_real_escape_string($this->conexao, $produto->getId());

	    $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', id_categoria= {$id_categoria}, usado = {$usado} where id = '{$id}'";

	    return mysqli_query($this->conexao, $query);
	}

	function removeProduto($id) {
		$id = mysqli_real_escape_string($this->conexao, $id);

		$query = "delete from produtos where id = {$id}";
		return mysqli_query($this->conexao, $query);
	}

	function buscaProduto($id) {
		$id = mysqli_real_escape_string($this->conexao, $id);
		
	    $query = "select * from produtos where id = {$id}";
	    $resultado = mysqli_query($this->conexao, $query);
	    $produto_array = mysqli_fetch_assoc($resultado);
	    
	    $produto = new Produto($produto_array['nome'], $produto_array['preco'], $produto_array['descricao']);
	    $produto->setId($produto_array['id']);
	    $produto->setUsado($produto_array['usado']);
	    $produto->categoria->setId($produto_array['id_categoria']);

	    return $produto;
	}

}