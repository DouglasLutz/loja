<?php
function listaProdutos($conexao){
	$produtos = array();
	$resultadoPesquisa = mysqli_query($conexao, "select p.id as id, p.nome as nome, p.preco as preco, p.descricao as descricao, c.nome as nome_categoria 
												from produtos p 
												inner join categorias c on c.id = p.categoria_id");

	while($produto = mysqli_fetch_assoc($resultadoPesquisa)){
		array_push($produtos, $produto);
	}

	return $produtos;
}

function alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado) {
    $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}',
        categoria_id= {$categoria_id}, usado = {$usado} where id = '{$id}'";
    return mysqli_query($conexao, $query);
}

function insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado) {
    $query = "insert into produtos (nome, preco, descricao, categoria_id, usado) values ('{$nome}', '{$preco}', '{$descricao}', '{$categoria_id}', '{$usado}')";
    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}

function removeProduto($conexao, $id) {
	$query = "delete from produtos where id = {$id}";
	return mysqli_query($conexao, $query);
}

function buscaProduto($conexao, $id) {
    $query = "select * from produtos where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}
