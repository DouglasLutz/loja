<?php 
	require_once("cabecalho.php");
	require_once("logica-usuario.php");

	retornaEstranhoParaLogin();

	$produto = new Produto($_POST["nome"], $_POST["preco"], $_POST["descricao"]);
	$produto->categoria->setId($_POST["categoria_id"]);

	if(array_key_exists('usado', $_POST)){
		$produto->setUsado(1);
	} else {
		$produto->setUsado(0);
	}

	$produtoDao = new ProdutoDao($conexao);

	if($produtoDao->insereProduto($produto)){
		?> <p class="text-success">Produto <?php echo $produto->getNome(); ?> adicionado com sucesso!</p> <?php
	} else {
		$msg = mysqli_error($conexao);
		?> <p class="text-danger">Produto não foi adicionado: <?= $msg ?> </p> <?php
	}


	require_once("rodape.php"); 
?>