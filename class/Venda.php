<?php 

include("ItemVenda.php");

class Venda{
	public $itens;

	function __construct(){
		$produtos = array();
	}

	function adicionaItens(ItemVenda $itemVenda){
		array_push($itens, $itemVenda);
	}

	function calculaValorTotal(){
		$total = 0;

		foreach ($itens as $itemVenda) {
			$total += $itemVenda->produto->valor * $itemVenda->quantidade;
		}

		return $total;
	}
}