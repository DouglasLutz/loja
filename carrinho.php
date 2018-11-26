<?php 
	require_once("cabecalho.php");
	retornaEstranhoParaLogin();

	$vendaDao = new VendaDao($conexao);
	$vendaAtiva = $vendaDao->getVendaAtiva();

	if($vendaAtiva){
		
	}
?>
	<h1>Carrinho: </h1>


	<?php  ?>



<?php
	require_once("rodape.php");
?>