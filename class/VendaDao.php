<?php
require_once("Venda.php");
require_once("ItemVendaDao.php");

class VendaDao{
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function getIdVendaAtiva($id_usuario){
		$query = "select id from vendas where id_usuario = '{$id_usuario}' and finalizada = '0'";

		$resultado = mysqli_query($this->conexao, $query);
		if($retorno = mysqli_fetch_assoc($resultado))
			return $retorno['id'];
		return 0;
	}

	function getVenda($id_venda){
		$query = "select id_produto from produto_venda where id_venda='{$id_venda}'";

		$itemVendaDao = new ItemVendaDao($this->conexao);

		$venda = new Venda();
		$resultado = mysqli_query($this->conexao, $query);

		while($item_array = mysqli_fetch_assoc($resultado)){
			$item_venda = $itemVendaDao->buscaItemVenda($id_venda, $item_array['id_produto']);
			$venda->adicionaItem($item_venda);
		}

		return $venda;
	}


	function getVendasCliente($id_usuario){
		$query = "select id, valor_total from vendas where id_usuario = '{$id_usuario}' and finalizada = '1'";

		$resultado = mysqli_query($this->conexao, $query);
		$vendas = array();

		while($venda_retorno = mysqli_fetch_assoc($resultado)){
			array_push($vendas, $venda_retorno);
		}

		return $vendas;
	}

	function criaNovaVenda($id_usuario){
		$query = "insert into vendas (id_usuario) value ({$id_usuario})";

		$resultado = mysqli_query($this->conexao, $query);
		
		if($resultado) {
			return $this->getIdVendaAtiva($id_usuario);
		}
		
		return $resultado;
	}

	function finalizaVenda($id){
		$query = "update vendas set finalizada = '1' where id = '{$id}'";
		$resultado = mysqli_query($this->conexao, $query);
		return $resultado;
	}


	function procedureProdutosVenda($id_venda){
		$query = "call new_procedure({$id_venda})";

		$resultado = mysqli_query($this->conexao, $query);
		$itens = array();

		while($item_array = mysqli_fetch_assoc($resultado)){
			array_push($itens, $item_array);
		}

		return $itens;
	}
}