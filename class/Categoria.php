<?php

class Categoria	{
	private $id;
	private $nome;

	public function __construct($nome = "") {
		$this->nome = $nome;
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

	public function setNome($valor){
		$this->nome = $valor;
	}	
}