<?php 

require_once("ItemVenda.php");

class Venda{
	public $itens;

	function __construct(){
		$this->itens = array();
	}

	function adicionaItem(ItemVenda $itemVenda){
		array_push($this->itens, $itemVenda);
	}

	function calculaValorTotal(){
		$total = 0;

		foreach ($this->itens as $itemVenda) {
			$total += $itemVenda->produto->getPreco() * $itemVenda->quantidade;
		}

		return $total;
	}

	function getVendasCliente($id_cliente){
		
	}
}