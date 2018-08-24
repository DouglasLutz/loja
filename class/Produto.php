<?php
require_once("Categoria.php");

class Produto {
	private $id;
	private $nome;
	private $preco;
	private $descricao;
	public $categoria;
	private $usado;

	public function __construct($nome, $preco, $descricao){
		$this->nome = $nome;
		$this->preco = $preco;
		$this->descricao = $descricao;
		$this->categoria = new Categoria();
	}

	public function getId(){
		return $this->id;
	}

	public function setId($valor){
		$this->id = $valor;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getPreco(){
		return $this->preco;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getUsado(){
		return $this->usado;
	}

	public function setUsado($valor){
		$this->usado = $valor;
	}

	public function precoComDesconto($valor = 0.1){
		if($valor > 0 && $valor <= 0.5){
			return $this->preco - ($this->preco * $valor);	
		} else {
			return $this->preco;
		}
		
	}

}