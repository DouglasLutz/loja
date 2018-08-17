<?php include("cabecalho.php"); ?>
<?php include("conectaBD.php"); ?>
<?php include("banco-produto.php"); ?>
<?php 
	$nome = $_POST["nome"];
	$preco = $_POST["preco"];
	$descricao = $_POST["descricao"];
	
	if(insereProduto($conexao, $nome, $preco, $descricao)){
		
		?> <p>Produto <?php echo $nome; ?> adicionado com sucesso!</p> <?php
	
	} else {

		$msg = mysqli_error($conexao);
		?> <p>Produto não foi adicionado: <?= $msg ?> </p> <?php

	}

	mysqli_close($conexao);
?>
<?php include("rodape.php"); ?>