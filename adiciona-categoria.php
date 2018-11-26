<?php 
	require_once("cabecalho.php");
	require_once("logica-usuario.php");

	retornaClienteParaHome();

	$categoria = new Categoria($_POST["nome"]);
	$categoriaDao = new CategoriaDao($conexao);

	if($categoriaDao->insereCategoria($categoria)){
		?> <p class="text-success">Categoria <?php echo $categoria->getNome(); ?> adicionada com sucesso!</p> <?php
	} else {
		$msg = mysqli_error($conexao);
		?> <p class="text-danger">Categoria não foi adicionada: <?= $msg ?> </p> <?php
	}

	require_once("rodape.php"); 
?>