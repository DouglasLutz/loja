<?php 
require_once("Produto.php");

class ItemVenda{
	public $produto;
	public $quantidade;

	function getPrecoTotal(){
		return $this->quantidade * $this->produto->getPreco();
	}
}