<?php 
	require_once("cabecalho.php");
	require_once("banco-produto.php");
	require_once("logica-usuario.php");

	require_once("class/Produto.php");
	require_once("class/Categoria.php");

	retornaEstranhoParaLogin();

	$produto = new Produto();

	$produto->setNome($_POST["nome"]);
	$produto->setPreco($_POST["preco"]);
	$produto->setDescricao($_POST["descricao"]);
	$produto->categoria->setId($_POST["categoria_id"]);

	if(array_key_exists('usado', $_POST)){
		$produto->setUsado(1);
	} else {
		$produto->setUsado(0);
	}

	if(insereProduto($conexao, $produto)){
		?> <p class="text-success">Produto <?php echo $produto->getNome(); ?> adicionado com sucesso!</p> <?php
	} else {
		$msg = mysqli_error($conexao);
		?> <p class="text-danger">Produto não foi adicionado: <?= $msg ?> </p> <?php
	}

	mysqli_close($conexao);
?>
<?php require_once("rodape.php"); ?>