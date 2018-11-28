<?php
require_once("ItemVenda.php");
require_once("ProdutoDao.php");

class ItemVendaDao{
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function buscaItemVenda($id_venda, $id_produto){
		$query = "select quantidade from produto_venda where id_produto = '{$id_produto}' and id_venda = '{$id_venda}'";
		
		$exec = mysqli_query($this->conexao, $query);
		$resultado = mysqli_fetch_assoc($exec);

		$itemVenda = new ItemVenda();
		$itemVenda->quantidade = $resultado['quantidade'];
		
		$produtoDao = new ProdutoDao($this->conexao);
		$itemVenda->produto = $produtoDao->buscaProduto($id_produto);

		return $itemVenda;
	}

	function insereItemVenda($id_venda, $id_produto, $quantidade){
		$query = "insert into produto_venda (id_venda, id_produto, quantidade) values ('{$id_venda}', '{$id_produto}', '{$quantidade}')";
		$resultado = mysqli_query($this->conexao, $query);
		return $resultado;
	}

	function removeItemVenda($id_venda, $id_produto){
		$query = "delete from produto_venda where id_venda = '{$id_venda}' and id_produto = '{$id_produto}'";
		$resultado = mysqli_query($this->conexao, $query);
		return $resultado;
	}
}