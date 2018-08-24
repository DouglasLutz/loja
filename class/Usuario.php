<?php

class Usuario {
	private $id;
	private $email;
	private $senhaMd5;

	public function __construct($email, $senha){
		$this->email = $email;
		$this->senhaMd5 = md5($senha);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getSenhaMd5(){
		return $this->senhaMd5;
	}

	public function __toString(){
		return $this->email;
	}
}