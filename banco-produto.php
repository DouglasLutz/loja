<?php
require_once("conectaBD.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

function listaProdutos($conexao){
	$produtos = array();
	$resultadoPesquisa = mysqli_query($conexao, "select p.id as id, p.nome as nome, p.preco as preco, p.descricao as descricao, c.nome as nome_categoria 
												from produtos p 
												inner join categorias c on c.id = p.categoria_id");

	while($produto_array = mysqli_fetch_assoc($resultadoPesquisa)){
		$produto = new Produto();
		$produto->setId($produto_array['id']);
		$produto->setNome($produto_array['nome']);
		$produto->setPreco($produto_array['preco']);
		$produto->setDescricao($produto_array['descricao']);
		$produto->categoria->setNome($produto_array['nome_categoria']);

		array_push($produtos, $produto);
	}

	return $produtos;
}

function insereProduto($conexao, Produto $produto) {
	$produto->setNome(mysqli_real_escape_string($conexao, $produto->getNome()));
	$produto->setPreco(mysqli_real_escape_string($conexao, $produto->getPreco()));
	$produto->setDescricao(mysqli_real_escape_string($conexao, $produto->getDescricao()));
	$produto->categoria->setId(mysqli_real_escape_string($conexao, $produto->categoria->getId()));
	$produto->setUsado(mysqli_real_escape_string($conexao, $produto->getUsado()));

    $query = "insert into produtos (nome, preco, descricao, categoria_id, usado) values 
    			('{$produto->getNome()}', 
    			 '{$produto->getPreco()}', 
    			 '{$produto->getDescricao()}', 
    			 '{$produto->categoria->getId()}', 
    			 '{$produto->getUsado()}')";

    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}

function alteraProduto($conexao, Produto $produto) {
	$produto->setNome(mysqli_real_escape_string($conexao, $produto->getNome()));
	$produto->setPreco(mysqli_real_escape_string($conexao, $produto->getPreco()));
	$produto->setDescricao(mysqli_real_escape_string($conexao, $produto->getDescricao()));
	$produto->categoria->setId(mysqli_real_escape_string($conexao, $produto->categoria->getId()));
	$produto->setUsado(mysqli_real_escape_string($conexao, $produto->getUsado()));

    $query = "update produtos set nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}',
        categoria_id= {$produto->categoria->getId()}, usado = {$produto->getUsado()} where id = '{$produto->getId()}'";

    return mysqli_query($conexao, $query);
}

function removeProduto($conexao, $id) {
	$id = mysqli_real_escape_string($conexao, $id);

	$query = "delete from produtos where id = {$id}";
	return mysqli_query($conexao, $query);
}

function buscaProduto($conexao, $id) {
	$id = mysqli_real_escape_string($conexao, $id);
	
    $query = "select * from produtos where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    $produto_array = mysqli_fetch_assoc($resultado);
    
    $produto = new Produto();
    $produto->setId($produto_array['id']);
	$produto->setNome($produto_array['nome']);
	$produto->setPreco($produto_array['preco']);
	$produto->setDescricao($produto_array['descricao']);
    $produto->setUsado($produto_array['usado']);
    $produto->categoria->setId($produto_array['categoria_id']);

    return $produto;
}
