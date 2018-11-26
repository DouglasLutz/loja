<?php

class VendaDao{
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function getVendaAtiva($id_usuario){
		$query = "select id_venda from vendas where id_usuario = '{$id_usuario}' and finalizada = '0'";

		$resultado = mysqli_query($this->conexao, $query);
		return mysqli_fetch_assoc($resultado);
	}


	function procedureProdutosVenda($id_venda){
		$query = "call new_procedure({$id_venda})";

		$resultado = mysqli_query($this->conexao, $query);
		$itens = array();

		while($item_array = mysqli_fetch_assoc($resultado)){
			
		}
		return ;
	}
}